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
