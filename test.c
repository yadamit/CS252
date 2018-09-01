#include<stdio.h>
#include<string.h>
int main(){
	char  input[100];
	scanf("%[^\n]s", input);
	printf("%s\n", input);
	printf("%ld\n", sizeof(input));

	// char del[2] = " ";

	// char * tokens = strtok(input, del);
	// while( tokens != NULL ) {
 //      printf( "%s\n", tokens );
    
 //      tokens = strtok(NULL, del);
   // }
	char str[]="Deba";
	char * new = strcat(str,"Hell");
	printf("%s\n",str);
	printf("%s\n",new);

}