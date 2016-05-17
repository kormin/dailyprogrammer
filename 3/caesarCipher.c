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
    return 0;
}
