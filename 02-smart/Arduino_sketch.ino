#include <LiquidCrystal.h>
#include <SoftwareSerial.h>
#include <ArduinoJson.h>
#include <Servo.h>

Servo myservo; //Servo-motor
LiquidCrystal lcd(7, 8, 9, 10, 11, 12); //LCD-Screen
SoftwareSerial s(5,6); //Connection to NodeMCU

const int temperaturePin = A0;
const int photoPin = A1;
int buttonPin =2;
int lightPin =13;

int pos = 0; //servo position
int lightVal = 0; //light sensor value  
int oldmos=-1;
int buttonState=0; //state of the button
int flag=0;

void setup() {
  //LCD START SCREEN
  lcd.begin(16, 2);                          
  lcd.print("Roses & Co");
  lcd.setCursor(0,1);
  lcd.print("Project");

  //SERIAL CONNECTION TO NODEMCU
  s.begin(9600);

  //PINMODES
  pinMode(lightPin, OUTPUT); 
  pinMode(buttonPin, INPUT_PULLUP); // enables internal pull-up resistor

  //SERIAL MONITOR
  Serial.begin(9600);
}

void loop() {
  //TEMPERATURE
  float voltage, degreesC;
  voltage = getVoltage(temperaturePin); //Measure the voltage at the analog pin
  degreesC = (voltage - 0.5) * 100.0; // Convert the voltage to degrees Celsius

  //LIGHT
  lightVal = analogRead(photoPin);

  //SOIL MOISTURE
  int  soil_mos;

  soil_mos=1023-analogRead(2);//get soil moisture value from A0 pin
  soil_mos=map(soil_mos, 0, 1023, 0, 100); //convert moisture value in percentage format

  //MANUAL ACTION WITH LED AND PUSHBUTTON --> FLAG IS USED FOR MAKING SERVO WORK
  buttonState = digitalRead(buttonPin);
  if(buttonState==LOW){
    if (flag ==0){
      digitalWrite(lightPin, HIGH);
      flag=1;
    } else if ( flag == 1){
        digitalWrite(lightPin, LOW);
        flag=0;
      }    
    }

  //AUTOMATIC ACTIVATION OF SERVO BY FLAG OR TEMPERATURE
  if (flag==0 || degreesC>25){
    myservo.attach(3);                    //servo goes on
    for (pos = 0; pos <= 180; pos += 1) { //from 0 degrees to 180 degrees in steps of 1 degree
      myservo.write(pos);               
      delay(15);                          //wait 15ms for the servo to reach the position
    }
    for (pos = 180; pos >= 0; pos -= 1) { //from 180 degrees back to 0 degrees
      myservo.write(pos);              
      delay(15);                          //wait 15ms for the servo to reach the position
    }
  } else {
    myservo.detach();                     //servo goes out
  }

  //LCD SCREEN DATA
  String stringOne = "Tmp: ";
  String stringTwo = String(degreesC);
  String stringTot= stringOne+stringTwo;
  String stringThree = "Lgt: ";
  String stringFour = String(lightVal);
  String string3 = " Wt: ";
  String string4 = String(soil_mos)+"%";
  String stringTot2 = stringThree+stringFour+string3+string4;

  Serial.println(stringTot);
  Serial.println(stringTot2);

  lcd.setCursor(0,0);
  lcd.print(stringTot);
  lcd.setCursor(0,1);
  lcd.print(stringTot2);

  //NODEMCU DATA
  StaticJsonBuffer<200> jsonBuffer;
  JsonObject& root = jsonBuffer.createObject();
  root["data1"] = degreesC;
  root["data2"] = lightVal;
  root["data3"] = soil_mos;
  root.printTo(s);

  //TIME DELAY
  delay(10000); //send data every 10 seconds --> need to press the button till the 10 seconds are over or perfectly on the 10th second to switch the light
}

//FUNCTION TO GET VOLTAGE TO CALCULATE TEMPERATURE
float getVoltage(int pin)
{
  return (analogRead(pin) * 0.004882814); 
}
