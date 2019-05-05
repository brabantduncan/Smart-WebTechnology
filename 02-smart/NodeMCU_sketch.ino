#include <SoftwareSerial.h>
#include <ArduinoJson.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

SoftwareSerial s(D6,D5);

String ssid ="telenet-CDA31"; //input your WiFi SSID
String password="zW1AQcU1huHZ"; //input your WiFi Password
String data;
String server = "www.duncanbrabant.be";
String temp, light, moist;
 
void setup() {
  //SERIAL MONITOR
  Serial.begin(9600);
  //SERIAL CONNECTION BETWEEN ARDUINO AND NODEMCU
  s.begin(9600);

  //WIFI CONNECTION
  Serial.print("Bezig met verbinden");
  WiFi.begin(ssid, password); // Connect to WiFi

  while (WiFi.status() != WL_CONNECTED) {
     delay(500);
     Serial.print(".");
  }
  Serial.println("OK!");
  Serial.print("SSID: ");
  Serial.println(WiFi.SSID());
  Serial.print("IP: ");
  Serial.println(WiFi.localIP());
  
  long rssi = WiFi.RSSI();
  Serial.print("Signaal sterkte (RSSI): ");
  Serial.print(rssi);
  Serial.println(" dBm");
  Serial.println("");
}

 
void loop() {
  //RECEIVE DATA FROM ARDUINO
  StaticJsonBuffer<1000> jsonBuffer;
  JsonObject& root = jsonBuffer.parseObject(s);
 
  Serial.println("JSON received and parsed");
  root.prettyPrintTo(Serial);
  Serial.println("Temp: ");
  Serial.println("");
  int data1=root["data1"];
  Serial.print(data1);
  Serial.print("Light: ");
  int data2=root["data2"];
  Serial.print(data2);
  Serial.println("");
  Serial.print("Moist: ");
  Serial.println("");
  int data3=root["data3"];
  Serial.print(data3);
  Serial.println("---------------------xxxxx--------------------");

  light = String(data2);
  temp= String(data1);
  moist=String(data3);


  //HTTP POST TO WEB APP
  HTTPClient http;    
 
  String postData;
  postData = "temp=" + temp + "&light=" + light + "&moist=" + moist;
  
  http.begin("http://duncanbrabant.be/postdemo.php");              
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");    
 
  int httpCode = http.POST(postData);   //Send the request
  String payload = http.getString();    //Get the response payload
 
  Serial.println(httpCode);
  Serial.println(payload);
 
  http.end();
  
  delay(10000);  //Post Data every 10 seconds
}
