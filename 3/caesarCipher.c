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
