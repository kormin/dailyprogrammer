/*
 * Author: https://github.com/kormin
 * Date Created: April 26, 2016
 * Description: This is the answer to the programming challenge #1 found in
 * https://www.reddit.com/r/dailyprogrammer/
 * Challenge: [difficult] challenge #1
 * Problem URL:
 * https://www.reddit.com/r/dailyprogrammer/comments/pii6j/difficult_challenge_1/
 * User input: h - number is too high, l - number is too low, y - number is correct
 */

#include <stdio.h>
#include <conio.h>

int main(){
	int num, fl=1, tries=0, ceil=101, flr=1;
	char ch;
	for(tries=0;fl;++tries){
		//system("cls");
		num = (ceil+flr)/2;
		printf("Is your number %d?",num);
		fflush(stdin);
		scanf("%c",&ch);
		if(ch=='h'){
			ceil=num;
		}else if(ch=='l'){
			flr=num;
		}else if(ch=='y'){
			fl=0;
		}
	}
	printf("Your number is: %d.\nAnswered in: %d tries.",num,tries);
	return 0;
}
