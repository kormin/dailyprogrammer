/*
 * Author: https://github.com/kormin
 * Date Created: May 10, 2016
 * Description: This is the answer to the programming challenge #2 found in
 * https://www.reddit.com/r/dailyprogrammer/
 * Challenge: [easy] challenge #3
 * Problem URL:
 * https://www.reddit.com/r/dailyprogrammer/comments/pkw2m/2112012_challenge_3_easy/
 * Resources:
 * https://en.wikipedia.org/wiki/Caesar_cipher
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

int main() {
    int n, i, i2, len;
    char x[50], x1[50];
    char en[90], de[90];
    printf("Enter shift: "); // requests for shift value
    scanf("%d",&n);
    printf("Enter your message: "); // requests message from user
    fflush(stdin);
    gets(x);
    len = strlen(x);
    for(i=0,i2=0;i<len;i++) {
        if(x[i]>=97 && x[i]<=122) { // make all caps
            x[i] = x[i] - 32;
        }
        if(x[i]>=65 && x[i]<=90) { // accepts all caps chars only
            x1[i2] = x[i] - 65;
            en[i2] = mod(x1[i2]+n, 26);
//            en[i2] = (x1[i2] + n) % 26; // encrypted string
            de[i2] = mod(en[i2]-n, 26);
//            de[i2] = (en[i2] - n) % 26; // decrypted string
            en[i2] = en[i2] + 65;
            de[i2] = de[i2] + 65;
        }else{ // ignore spaces, periods, etc...
            en[i2] = x[i];
            de[i2] = x[i];
        }
        ++i2;
    }
    return 0;
}
