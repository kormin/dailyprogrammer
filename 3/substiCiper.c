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
    return 0;
}
