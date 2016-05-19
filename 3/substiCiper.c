/*
 * Author: https://github.com/kormin
 * Date Created: May 10, 2016
 * Description: This is the answer to the programming challenge #3 found in
 * https://www.reddit.com/r/dailyprogrammer/
 * Challenge: [intermediate] challenge #3
 * Problem URL:
 * https://www.reddit.com/r/dailyprogrammer/comments/pkwb1/2112012_challenge_3_intermediate/
 * Resources:
 * https://en.wikipedia.org/wiki/Substitution_cipher
 */

#include<stdio.h>
#include<conio.h>
#include<string.h>

/*
* Modulo function to handle negative numbers
* http://stackoverflow.com/questions/4003232/how-to-code-a-modulo-operator-in-c-c-obj-c-that-handles-negative-numbers
*/
int mod (int a, int b) {
   if(b < 0) //you can check for b == 0 separately and do what you want
     return mod(-a, -b);
   int ret = a % b;
   if(ret < 0)
     ret+=b;
   return ret;
}

void toUpper (char *s, int len) { // my fx which accepts str ptr and len making str uppercase
    int i;
    for(i=0;i<len;i++) {
        if(*(s+i)>=97 && *(s+8)<=122) {
            *(s+i) = *(s+i) - 32;
        }
    }
}

int main() {
    char alph[27] = {'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','\0'};
    char alph1[27] = {'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','\0'};
    char key[50];
    char msg[80], en[80], de[80];
    int i, i1, i2, i3, len1, len2;
    printf("Enter your keyword: "); // request for key
    gets(key);
    len1 = strlen(alph); // alph len should be same as cipher len
    len2 = strlen(key);
    char cipher[len1];
    int rept[len2];
    // Start building cipher
    toUpper(&key[0], len2);
    for(i=0, i2=0;i<len2;i++) {
        rept[i] = 0;
        for(i1=0;i1<len2;i1++) { // checks for duplicates in key array
            if(key[i] == key[i1]) {
                rept[i]++;
            }
        }
        if(rept[i]>1) { // check for repeat letters
            key[i] = '*';
            i2++;
        }
    }
    char key1[len2-i2];
    int len3 = len2-i2;
    for(i=0,i1=0;i<len2;i++) { // removes duplicate letter and places in key1 array
        if(key[i]!='*') {
            key1[i1++]=key[i];
        }
    }
    for(i=0;i<len3;i++) { // checks key1 against alphabet array and places key1 first in cipher arr removing key1 values from alph arr
        for(i1=0;i1<len1;i1++) {
            if(key1[i] == alph[i1]) {
                alph[i1] = '*';
                cipher[i] = key1[i];
                break;
            }
        }
    }
    for(i=0,i1=0;i<len1;i++) { // adds alph values not in key1 arr to the end of cipher arr
        if(alph[i]!='*') {
            cipher[len3+i1] = alph[i];
            i1++;
        }
    }
    alph[i] = '\0';
    cipher[i] = '\0';
    // Finish building cipher
    printf("Enter your message: "); // request for msg
    fflush(stdin); // clears input buffer
    gets(msg);
    int msgLen = strlen(msg);
    toUpper(&msg[0], msgLen);
    // Start encrypting msg using alph arr
    // Start decrypting en using cipher arr
    for(i=0, i2=0, i3=0;i<msgLen;i++) {
        for(i1=0;i1<len1;i1++) {
            if(msg[i]==alph1[i1]) { // encrypts msg using alph1
                en[i2++] = cipher[i1];
            }
            if(en[i]==cipher[i1]) { // decrypts en using cipher
                de[i3++] = alph1[i1];
            }
        }
        if(!(msg[i]>=65 && msg[i]<=90)) { // code to ignore spaces, periods, etc...
            en[i2++] = msg[i];
        }
        if(!(en[i]>=65 && en[i]<=90)) { // code to ignore spaces, periods, etc...
            de[i3++] = en[i];
        }
    }
    en[i2]='\0';
    de[i2]='\0';
    // End encrypting msg using alph arr
    // End decrypting en using cipher arr
    printf("Encrypted message: ");
    puts(en);
    printf("Decrypted message: ");
    puts(de);
    return 0;
}
