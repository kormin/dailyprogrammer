/*
 * Author: https://github.com/kormin
 * Date Created: May 11, 2016
 * Description: This is the answer to the programming challenge #7 found in
 * https://www.reddit.com/r/dailyprogrammer/
 * Challenge: [easy] challenge #7
 * Problem URL:
 * https://www.reddit.com/r/dailyprogrammer/comments/pr2xr/2152012_challenge_7_easy/
 * Resources:
 * https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/International_Morse_Code.svg/450px-International_Morse_Code.svg.png
 */

#include <iostream>
#include <string>

using namespace std;

const string txt = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
const string mrse[36] = {".-","-...","-.-.","-..",".","..-.","--.","....","..",".---","-.-",
".-..","--","-.","---",".--.","--.-",".-.","...","-","..-","...-",".--","-..-","-.--","--..",
".----","..---","...--","....-",".....","-....","--...","---..","----.","-----"};
const char spc1 = ' ';
const string spc2 = " / "; // space between words is 7 units;
int len1 = txt.length();
int len2 = spc2.length();

string getInp () {
    string str;
    cout<<"Enter your message: ";
    cin.sync(); // clears input buffer
    getline(cin, str); // gets string input from user
    for(int i=0;i<str.length();i++) {
        str[i]=toupper(str[i]);
    }
    return str;
}

string getMorse(string msg, int len) {
    string res;
    int i, i1;
    for(i=0;i<len;i++) {
        if(msg[i] == spc1) {
            res += spc2;
        }else{
            for(i1=0;i1<len1;i1++) {
                if(msg[i] == txt[i1]) {
                    res += (mrse[i1] + " ");
                }
            }
        }
    }
    return res;
}

string getText(string msg, int len) {
    string res;
    int i, i1, i2, i3, cnt=0, tmp;
    for(i=0;i<len;i++) {
        for(i1=0;i1<len1;i1++) { // txt length
            for(i3=0;(msg[i+i3] == spc2[i3]) && (i3<len2);i3++); // checks if word is coming
            if(i3>=len2) { // word is coming
                i += i3-1; // get index of starting morse code for next letter
                res += " "; // add space
            }
            tmp = mrse[i1].length(); // get length of each morse code from mrse array
            for(i2=0;(msg[i+i2] == mrse[i1][i2]) && (i2<tmp);i2++); // mrse length of each string
            if(((msg[i+i2]==spc1 && i3<len2) || (i+i2)>=len) && i2>=tmp) { // gets txt char
                res += txt[i1];
                i += i2;
            }
        }
    }
    return res;
}

int main() { // for [2] if 0 has space after, the space will not be displayed
    int c, len;
    string msg, res;
    cout<<"Enter a choice: "<<endl<<"[1] Text to Morse code"<<endl<<"[2] Morse code to text"<<endl<<"Choice: ";
    cin>>c;
    if(c==1 || c==2) {
        msg = getInp();
        len = msg.length();
        if(c==1){
            res = getMorse(msg, len);
        }else{
            res = getText(msg, len);
        }
        cout<<res;
    }
    return 0;
}
