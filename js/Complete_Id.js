function complete_id(id_num)
{
  var id_string = id_num;
  var lastno = 0;
  var idsum = 0;
  var i = 1;
  while (i <= 8)
  {
	  if(substr(id_string,i,1) != 9
				{
					idsum = idsum + 
				}
				
  }
  
  
	}
//////////////
  WHILE I <= 8 LOOP

     IF TO_NUMBER(SUBSTR(ID_STRING,I,1)) <> 9 THEN
        IDSUM := IDSUM + MOD(TO_NUMBER(SUBSTR(ID_STRING,I,1))* (MOD(I-1,2)+1),9);
     ELSE
        IDSUM := IDSUM + 9;
     END IF;
     I := I + 1;
  END LOOP;