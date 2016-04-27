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
