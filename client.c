
/* credit @Daniel Scocco */

/****************** CLIENT CODE ****************/

#include <stdio.h>
#include<stdlib.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <string.h>
#include <arpa/inet.h>

char* concat(const char *s1, const char *s2)
{
    char *result = malloc(strlen(s1) + strlen(s2) + 1); // +1 for the null-terminator
    // in real code you would check for errors in malloc here
    strcpy(result, s1);
    strcat(result, s2);
    return result;
}

void lowercase(char* str){
	int i=0;
	int n = strlen(str);
	for(i=0;i<n;i++){
		if(str[i]-'a'>=0 && str[i]-'a'<=25){
		}
		else{
			str[i] = str[i]-'A' + 'a';
		}
	}
//return str;

}

int main(){
  int clientSocket;
  //char buffer[1024];
  struct sockaddr_in serverAddr;
  socklen_t addr_size;

  /*---- Create the socket. The three arguments are: ----*/
  /* 1) Internet domain 2) Stream socket 3) Default protocol (TCP in this case) */
  clientSocket = socket(PF_INET, SOCK_STREAM, 0);

  /*---- Configure settings of the server address struct ----*/
  /* Address family = Internet */
  serverAddr.sin_family = AF_INET;
  /* Set port number, using htons function to use proper byte order */
  serverAddr.sin_port = htons(10000);
  /* Set IP address to localhost */
  serverAddr.sin_addr.s_addr = inet_addr("127.0.0.1");
  /* Set all bits of the padding field to 0 */
  memset(serverAddr.sin_zero, '\0', sizeof serverAddr.sin_zero);

  /*---- Connect the socket to the server using the address struct ----*/
  addr_size = sizeof serverAddr;
	int succ =   connect(clientSocket, (struct sockaddr *) &serverAddr, addr_size);
	if(succ==-1){
		return 0;
	}
  /*---- Read the message from the server into the buffer ----*/
 //  while(1){
	// 	char * buffer;
	// 	buffer = malloc(1024*sizeof(char));
	// 	int fuck = recv(clientSocket, buffer, 1024, 0);
	// 	if(fuck==-1 || fuck==0) return 0;
	// 	buffer[fuck]='\0';
	// 	lowercase(buffer);
	// 	printf("Data received: %s\n",buffer);
	// 	free(buffer);
	// }

	// /////////Scan number of images you want and scan same number of file names you want///////////////
	// int n=0;
	// printf("Sending number of files\n");
	// scanf("%d", &n);
	// send(clientSocket, &n, sizeof(n), 0);

	// char file_name[n][100];
	// int i=0;
	// for(i=0;i<n;i++){
	// 	scanf("%s", file_name[i]);		
	// 	printf("Sending filename = %s\n", file_name[i]);
	// 	send(clientSocket, file_name[i], sizeof(file_name[i]), 0);
	// }

	
	/////////////// Scan user input, for ex: 2 dogs 3 cats and 2 cars ////////////////////////
	char  input[100];
	long int size = 0;
	scanf("%[^\n]s", input);
	printf("input recieved: %s\n", input);
	printf("sending input size: %ld\n", sizeof(input));
	size = sizeof(input);
	send(clientSocket, &size, sizeof(long int),  0);
	printf("sending input\n");
	send(clientSocket, input, sizeof(input), 0);

	
	int n=0;
	printf("Recieving number of files: ");
	recv(clientSocket, &n, sizeof(int), 0);

	char *recieved_file[16]={"r1.jpg","r2.jpg","r3.jpg","r4.jpg","r5.jpg","r6.jpg","r7.jpg","r8.jpg","r9.jpg",
							"r10.jpg","r11.jpg","r12.jpg","r13.jpg","r14.jpg","r15.jpg","r16.jpg"};
	for(int i=0;i<n;i++){
		int size=0;
		printf("Recieving file size: ");
		recv(clientSocket, &size, sizeof(int), 0);
		printf("size = %d\n", size);

		char buffer[size];
		int r=0;
		printf("Recieving file:\n");
		r = recv(clientSocket, buffer, size, 0);
		printf("Recieved file of size = %d\n", r);
		// printf("%s\n", buffer);

		FILE * file = fopen(recieved_file[i], "w");
		fwrite(buffer, 1, sizeof(buffer), file);
		printf("Writing completed in %s\n", recieved_file[i]);
	}


  return 0;
}
