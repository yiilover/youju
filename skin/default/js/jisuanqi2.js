function exc_zuhe(fmobj,v){
	//var fmobj=document.calc1;
	if (fmobj.name=="calc1"){
		if (v==3){
			document.getElementById('calc1_zuhe').style.display='block';
			fmobj.jisuan_radio[1].checked = true;
			exc_js(fmobj,2);
		}else{
			document.getElementById('calc1_zuhe').style.display='none';
		}
	}else{
		if (v==3){
			document.getElementById('calc2_zuhe').style.display='block';
			fmobj.jisuan_radio[1].checked = true;
			exc_js(fmobj,2);
		}else{
			document.getElementById('calc2_zuhe').style.display='none';
		}
	}
}
function exc_js(fmobj,v){
	//var fmobj=document.calc1;
	if (fmobj.name=="calc1"){
		if (v==1){
			document.getElementById('calc1_js_div1').style.display='block';
			document.getElementById('calc1_js_div2').style.display='none';
			document.getElementById('calc1_zuhe').style.display='none';
			fmobj.type.value=1;
		}else{
			document.getElementById('calc1_js_div1').style.display='none';
			document.getElementById('calc1_js_div2').style.display='block';
		}
	}else{
		if (v==1){
			document.getElementById('calc2_js_div1').style.display='block';
			document.getElementById('calc2_js_div2').style.display='none';
			document.getElementById('calc2_zuhe').style.display='none';
			fmobj.type.value=1;
		}else{
			document.getElementById('calc2_js_div1').style.display='none';
			document.getElementById('calc2_js_div2').style.display='block';
		}
	}
}
function formReset(fmobj){
	//var fmobj=document.calc1;
	if (fmobj.name=="calc1"){
		document.getElementById('calc1_js_div1').style.display='block';
		document.getElementById('calc1_js_div2').style.display='none';
		document.getElementById('calc1_zuhe').style.display='none';
		document.getElementById('calc1_benjin').style.display='none';
	}else{
		document.getElementById('calc2_js_div1').style.display='block';
		document.getElementById('calc2_js_div2').style.display='none';
		document.getElementById('calc2_zuhe').style.display='none';
		document.getElementById('calc2_benxi').style.display='none';
	}
}

//��ʾ�ұߵıȽ�div
function showRightDiv(fmobj){
	if (ext_total(fmobj)==false){return;}
	//alert(document.calc1.month_money2.value);
	var a=window.open('','calc_win','status=yes,scrollbars=yes,resizable=yes,width=550,height=500,left=0,top=0')//790*520
	if (fmobj.name=="calc1"){
		document.calc1.target = "calc_win";
		document.calc1.submit();
	}else{
		document.calc2.target = "calc_win";
		document.calc2.submit();
	}

}


//��֤�Ƿ�Ϊ����
function reg_Num(str){
	if (str.length==0){return false;}
	var Letters = "1234567890.";

	for (i=0;i<str.length;i++){
		var CheckChar = str.charAt(i);
		if (Letters.indexOf(CheckChar) == -1){return false;}
	}
	return true;
}

lilv_array=new Array;          
//2004��֮ǰ�ľ�����
lilv_array[1]=new Array;
lilv_array[1][1]=new Array;
lilv_array[1][2]=new Array;
lilv_array[1][1][5]=0.0477;//�̴� 1��5�� 4.77%
lilv_array[1][1][10]=0.0504;//�̴� 5-30�� 5.04%
lilv_array[1][2][5]=0.0360;//������ 1��5�� 3.60%
lilv_array[1][2][10]=0.0405;//������ 5-30�� 4.05%

//2005��	1�µ�������
lilv_array[2]=new Array;
lilv_array[2][1]=new Array;
lilv_array[2][2]=new Array;
lilv_array[2][1][5]=0.0495;//�̴� 1��5�� 4.95%
lilv_array[2][1][10]=0.0531;//�̴� 5-30�� 5.31%
lilv_array[2][2][5]=0.0378;//������ 1��5�� 3.78%
lilv_array[2][2][10]=0.0423;//������ 5-30�� 4.23%

//2006��	1�µ�����������
lilv_array[3]=new Array;
lilv_array[3][1]=new Array;
lilv_array[3][2]=new Array;
lilv_array[3][1][5]=0.0527;//�̴� 1��5�� 5.27%
lilv_array[3][1][10]=0.0551;//�̴� 5-30�� 5.51%
lilv_array[3][2][5]=0.0396;//������ 1��5�� 3.96%
lilv_array[3][2][10]=0.0441;//������ 5-30�� 4.41%
			
//2006��	1�µ�����������
lilv_array[4]=new Array;
lilv_array[4][1]=new Array;
lilv_array[4][2]=new Array;
lilv_array[4][1][5]=0.0527;//�̴� 1��5�� 5.27%
lilv_array[4][1][10]=0.0612;//�̴� 5-30�� 6.12%
lilv_array[4][2][5]= 0.0396;//������ 1��5�� 3.96%
lilv_array[4][2][10]=0.0441;//������ 5-30�� 4.41%

//2006��	4��28�յ�����������
lilv_array[5]=new Array;
lilv_array[5][1]=new Array;
lilv_array[5][2]=new Array;
lilv_array[5][1][5]=0.0551;//�̴� 1��5�� 5.51%
lilv_array[5][1][10]=0.0575;//�̴� 5-30�� 5.75%
lilv_array[5][2][5]= 0.0414;//������ 1��5�� 4.14%
lilv_array[5][2][10]=0.0459;//������ 5-30�� 4.59%

//2006��	4��28�յ�����������
lilv_array[6]=new Array;
lilv_array[6][1]=new Array;
lilv_array[6][2]=new Array;
lilv_array[6][1][5]=0.0612;//�̴� 1��5�� 6.12%
lilv_array[6][1][10]=0.0639;//�̴� 5-30�� 6.39%
lilv_array[6][2][5]= 0.0414;//������ 1��5�� 4.14%
lilv_array[6][2][10]=0.0459;//������ 5-30�� 4.59%

//2006��	8��19�յ�����������
lilv_array[7]=new Array;
lilv_array[7][1]=new Array;
lilv_array[7][2]=new Array;
lilv_array[7][1][5]=0.0551;//�̴� 1��5�� 5.51%
lilv_array[7][1][10]=0.0581;//�̴� 5-30�� 5.81%
lilv_array[7][2][5]= 0.0414;//������ 1��5�� 4.14%
lilv_array[7][2][10]=0.0459;//������ 5-30�� 4.59%

//2006��	8��19�յ�����������
lilv_array[8]=new Array;
lilv_array[8][1]=new Array;
lilv_array[8][2]=new Array;
lilv_array[8][1][5]=0.0648;//�̴� 1��5�� 6.48%
lilv_array[8][1][10]=0.0684;//�̴� 5-30�� 6.84%
lilv_array[8][2][5]= 0.0414;//������ 1��5�� 4.14%
lilv_array[8][2][10]=0.0459;//������ 5-30�� 4.59%


//2007��	3��18�յ�����������
lilv_array[9]=new Array;
lilv_array[9][1]=new Array;
lilv_array[9][2]=new Array;
lilv_array[9][1][5]=0.0574;//�̴� 1��5�� 5.74%
lilv_array[9][1][10]=0.0604;//�̴� 5-30�� 6.04%
lilv_array[9][2][5]=0.0432;//������ 1��5�� 4.32%
lilv_array[9][2][10]=0.0477;//������ 5-30�� 4.77%

//2007��	3��18�յ�����������
lilv_array[10]=new Array;
lilv_array[10][1]=new Array;
lilv_array[10][2]=new Array;
lilv_array[10][1][5]=0.0675;//�̴� 1��5�� 6.75%
lilv_array[10][1][10]=0.0711;//�̴� 5-30�� 7.11%
lilv_array[10][2][5]=0.0432;//������ 1��5�� 4.32%
lilv_array[10][2][10]=0.0477;//������ 5-30�� 4.77%


//2007��	5��19�յ�����������
lilv_array[11]=new Array;
lilv_array[11][1]=new Array;
lilv_array[11][2]=new Array;
lilv_array[11][1][5]=0.0589;//�̴� 1��5�� 5.89%
lilv_array[11][1][10]=0.0612;//�̴� 5-30�� 6.12%
lilv_array[11][2][5]=0.0441;//������ 1��5�� 4.41%%
lilv_array[11][2][10]=0.0486;//������ 5-30�� 4.86%%

//2007��	5��19�յ�����������
lilv_array[12]=new Array;
lilv_array[12][1]=new Array;
lilv_array[12][2]=new Array;
lilv_array[12][1][5]=0.0693;//�̴� 1��5�� 6.93%
lilv_array[12][1][10]=0.0720;//�̴� 5-30�� 7.20%
lilv_array[12][2][5]=0.0441;//������ 1��5�� 4.41%%
lilv_array[12][2][10]=0.0486;//������ 5-30�� 4.86%%

//2007��	7��21�յ�����������
lilv_array[13]=new Array;
lilv_array[13][1]=new Array;
lilv_array[13][2]=new Array;
lilv_array[13][1][5]=0.0612;//�̴� 1��5�� 6.12%
lilv_array[13][1][10]=0.06273;//�̴� 5-30�� 6.273%
lilv_array[13][2][5]=0.0450;//������ 1��5�� 4.50%%
lilv_array[13][2][10]=0.0495;//������ 5-30�� 4.95%%

//2007��	7��21�յ�����������
lilv_array[14]=new Array;
lilv_array[14][1]=new Array;
lilv_array[14][2]=new Array;
lilv_array[14][1][5]=0.0720;//�̴� 1��5�� 7.20%
lilv_array[14][1][10]=0.0738;//�̴� 5-30�� 7.38%
lilv_array[14][2][5]=0.0450;//������ 1��5�� 4.50%%
lilv_array[14][2][10]=0.0495;//������ 5-30�� 4.95%%

//2007��	8��22�յ�����������
lilv_array[15]=new Array;
lilv_array[15][1]=new Array;
lilv_array[15][2]=new Array;
lilv_array[15][1][5]=0.06273;//�̴� 1��5�� 6.273%
lilv_array[15][1][10]=0.06426;//�̴� 5-30�� 6.426%
lilv_array[15][2][5]=0.0459;//������ 1��5�� 4.59%
lilv_array[15][2][10]=0.0504;//������ 5-30�� 5.04%

//2007��	8��22�յ�����������
lilv_array[16]=new Array;
lilv_array[16][1]=new Array;
lilv_array[16][2]=new Array;
lilv_array[16][1][5]=0.0738;//�̴� 1��5�� 7.38%
lilv_array[16][1][10]=0.0756;//�̴� 5-30�� 7.56%
lilv_array[16][2][5]=0.0459;//������ 1��5�� 4.59%
lilv_array[16][2][10]=0.0504;//������ 5-30�� 5.04%

//2007��	9��15�յ�����������
lilv_array[17]=new Array;
lilv_array[17][1]=new Array;
lilv_array[17][2]=new Array;
lilv_array[17][1][5]=0.06503;//�̴� 1��5�� 6.503%
lilv_array[17][1][10]=0.06656;//�̴� 5-30�� 6.656%
lilv_array[17][2][5]=0.0477;//������ 1��5�� 4.77%
lilv_array[17][2][10]=0.0522;//������ 5-30�� 5.22%

//2007��	9��15�յ�����������
lilv_array[18]=new Array;
lilv_array[18][1]=new Array;
lilv_array[18][2]=new Array;
lilv_array[18][1][5]=0.0765;//�̴� 1��5�� 7.65%
lilv_array[18][1][10]=0.0783;//�̴� 5-30�� 7.83%
lilv_array[18][2][5]=0.0477;//������ 1��5�� 4.77%
lilv_array[18][2][10]=0.0522;//������ 5-30�� 5.22%

//2007��	9��15��������(�ڶ��׷�)
lilv_array[19]=new Array;
lilv_array[19][1]=new Array;
lilv_array[19][2]=new Array;
lilv_array[19][1][5]=0.08415;//�̴� 1��5�� 8.415%
lilv_array[19][1][10]=0.08613;//�̴� 5-30�� 8.613%
lilv_array[19][2][5]=0.0477;//������ 1��5�� 4.77%
lilv_array[19][2][10]=0.0522;//������ 5-30�� 5.22%


//2007��	12��21�յ�����������
lilv_array[20]=new Array;
lilv_array[20][1]=new Array;
lilv_array[20][2]=new Array;
lilv_array[20][1][5]=0.06579;//�̴� 1��5�� 6.579%
lilv_array[20][1][10]=0.06656;//�̴� 5-30�� 6.656%
lilv_array[20][2][5]=0.0477;//������ 1��5�� 4.77%
lilv_array[20][2][10]=0.0522;//������ 5-30�� 5.22%

//2007��	12��21�յ�����������
lilv_array[21]=new Array;
lilv_array[21][1]=new Array;
lilv_array[21][2]=new Array;
lilv_array[21][1][5]=0.0774;//�̴� 1��5�� 7.74%
lilv_array[21][1][10]=0.0783;//�̴� 5-30�� 7.83%
lilv_array[21][2][5]=0.0477;//������ 1��5�� 4.77%
lilv_array[21][2][10]=0.0522;//������ 5-30�� 5.22%

//2007��	12��21��������(�ڶ��׷�)
lilv_array[22]=new Array;
lilv_array[22][1]=new Array;
lilv_array[22][2]=new Array;
lilv_array[22][1][5]=0.08514;//�̴� 1��5�� 8.514%
lilv_array[22][1][10]=0.08613;//�̴� 5-30�� 8.613%
lilv_array[22][2][5]=0.0477;//������ 1��5�� 4.77%
lilv_array[22][2][10]=0.0522;//������ 5-30�� 5.22%

//2008��	9��16�յ�����������
lilv_array[23]=new Array;
lilv_array[23][1]=new Array;
lilv_array[23][2]=new Array;
lilv_array[23][1][5]=0.06426;//�̴� 1��5�� 6.426%
lilv_array[23][1][10]=0.06579;//�̴� 5-30�� 6.579%
lilv_array[23][2][5]=0.0459;//������ 1��5�� 4.59%
lilv_array[23][2][10]=0.0513;//������ 5-30�� 5.13%

//2008��	9��16�յ�����������
lilv_array[24]=new Array;
lilv_array[24][1]=new Array;
lilv_array[24][2]=new Array;
lilv_array[24][1][5]=0.0756;//�̴� 1��5�� 7.56%
lilv_array[24][1][10]=0.0774;//�̴� 5-30�� 7.74%
lilv_array[24][2][5]=0.0459;//������ 1��5�� 4.59%
lilv_array[24][2][10]=0.0513;//������ 5-30�� 5.13%

//2008��	9��16��������(�ڶ��׷�)
lilv_array[25]=new Array;
lilv_array[25][1]=new Array;
lilv_array[25][2]=new Array;
lilv_array[25][1][5]=0.08316;//�̴� 1��5�� 8.316%
lilv_array[25][1][10]=0.08514;//�̴� 5-30�� 8.514%
lilv_array[25][2][5]=0.0459;//������ 1��5�� 4.59%
lilv_array[25][2][10]=0.0513;//������ 5-30�� 5.13%

//2008��	10��9�յ�����������
lilv_array[26]=new Array;
lilv_array[26][1]=new Array;
lilv_array[26][2]=new Array;
lilv_array[26][1][5]=0.061965;//�̴� 1��5�� 6.1965%
lilv_array[26][1][10]=0.063495;//�̴� 5-30�� 6.3495%
lilv_array[26][2][5]=0.0432;//������ 1��5�� 4.32%
lilv_array[26][2][10]=0.0486;//������ 5-30�� 4.86%

//2008��	10��9�յ�����������
lilv_array[27]=new Array;
lilv_array[27][1]=new Array;
lilv_array[27][2]=new Array;
lilv_array[27][1][5]=0.0729;//�̴� 1��5�� 7.29%
lilv_array[27][1][10]=0.0747;//�̴� 5-30�� 7.47%
lilv_array[27][2][5]=0.0432;//������ 1��5�� 4.32%
lilv_array[27][2][10]=0.0486;//������ 5-30�� 4.86%

//2008��	10��9��������(�ڶ��׷�)
lilv_array[28]=new Array;
lilv_array[28][1]=new Array;
lilv_array[28][2]=new Array;
lilv_array[28][1][5]=0.08019;//�̴� 1��5�� 8.019%
lilv_array[28][1][10]=0.08217;//�̴� 5-30�� 8.217%
lilv_array[28][2][5]=0.0432;//������ 1��5�� 4.32%
lilv_array[28][2][10]=0.0486;//������ 5-30�� 4.86%


//2008��	10��30�ջ�׼����
lilv_array[30]=new Array;
lilv_array[30][1]=new Array;
lilv_array[30][2]=new Array;
lilv_array[30][1][5]=0.0702;//�̴� 1��5�� 7.02%
lilv_array[30][1][10]=0.072;//�̴� 5-30�� 7.20%
lilv_array[30][2][5]=0.0405;//������ 1��5�� 4.05%
lilv_array[30][2][10]=0.0459;//������ 5-30�� 4.59%

//2008��	11��27�ջ�׼����
lilv_array[31]=new Array;
lilv_array[31][1]=new Array;
lilv_array[31][2]=new Array;
lilv_array[31][1][5]=0.0594;//�̴� 1��5�� 5.94%
lilv_array[31][1][10]=0.0612;//�̴� 5-30�� 6.12%
lilv_array[31][2][5]=0.0351;//������ 1��5�� 3.51%
lilv_array[31][2][10]=0.0405;//������ 5-30�� 4.05%

//2008��	12��23����������(7��)
lilv_array[32]=new Array;
lilv_array[32][1]=new Array;
lilv_array[32][2]=new Array;
lilv_array[32][1][5]=0.0576*0.7;//�̴� 1��5�� 5.76%    
lilv_array[32][1][10]=0.0594*0.7;//�̴� 5-30�� 5.94%   
lilv_array[32][2][5]=0.0333;//������ 1��5�� 3.33%  
lilv_array[32][2][10]=0.0387;//������ 5-30�� 3.87% 

//2008��	12��23����������(85��)
lilv_array[33]=new Array;
lilv_array[33][1]=new Array;
lilv_array[33][2]=new Array;
lilv_array[33][1][5]=0.0576*0.85;//�̴� 1��5�� 5.76%    
lilv_array[33][1][10]=0.0594*0.85;//�̴� 5-30�� 5.94%   
lilv_array[33][2][5]=0.0333;//������ 1��5�� 3.33%  
lilv_array[33][2][10]=0.0387;//������ 5-30�� 3.87% 

//2008��	12��23�ջ�׼����
lilv_array[34]=new Array;
lilv_array[34][1]=new Array;
lilv_array[34][2]=new Array;
lilv_array[34][1][5]=0.0576;//�̴� 1��5�� 5.76%
lilv_array[34][1][10]=0.0594;//�̴� 5-30�� 5.94%
lilv_array[34][2][5]=0.0333;//������ 1��5�� 3.33%
lilv_array[34][2][10]=0.0387;//������ 5-30�� 3.87%

//2008��	12��23����������(1.1��)
lilv_array[35]=new Array;
lilv_array[35][1]=new Array;
lilv_array[35][2]=new Array;
lilv_array[35][1][5]=0.0576*1.1;//�̴� 1��5�� 5.76%    
lilv_array[35][1][10]=0.0594*1.1;//�̴� 5-30�� 5.94%   
lilv_array[35][2][5]=0.0333*1.1;//������ 1��5�� 3.33%  
lilv_array[35][2][10]=0.0387*1.1;//������ 5-30�� 3.87% 


//2010��	10��20����������(7��)
lilv_array[36]=new Array;
lilv_array[36][1]=new Array;
lilv_array[36][2]=new Array;
lilv_array[36][1][5]=0.0596*0.7;    
lilv_array[36][1][10]=0.0614*0.7;  
lilv_array[36][2][5]=0.0350; 
lilv_array[36][2][10]=0.0405; 

//2010��	10��20����������(85��)
lilv_array[37]=new Array;
lilv_array[37][1]=new Array;
lilv_array[37][2]=new Array;
lilv_array[37][1][5]=0.0596*0.85; 
lilv_array[37][1][10]=0.0614*0.85;  
lilv_array[37][2][5]=0.0350; 
lilv_array[37][2][10]=0.0405;

//2010��	10��20�ջ�׼����
lilv_array[38]=new Array;
lilv_array[38][1]=new Array;
lilv_array[38][2]=new Array;
lilv_array[38][1][5]=0.0596;//�̴� 1��5�� 5.96%
lilv_array[38][1][10]=0.0614;//�̴� 5-30�� 6.14%
lilv_array[38][2][5]=0.0350;//������ 1��5�� 3.50%
lilv_array[38][2][10]=0.0405;//������ 5-30�� 4.05%

//2010��	10��20����������(1.1��)
lilv_array[39]=new Array;
lilv_array[39][1]=new Array;
lilv_array[39][2]=new Array;
lilv_array[39][1][5]=0.0596*1.1; 
lilv_array[39][1][10]=0.0614*1.1; 
lilv_array[39][2][5]=0.0350*1.1;
lilv_array[39][2][10]=0.0405*1.1;

//2010��	12��26����������(7��)
lilv_array[40]=new Array;
lilv_array[40][1]=new Array;
lilv_array[40][2]=new Array;
lilv_array[40][1][5]=0.0622*0.7;    
lilv_array[40][1][10]=0.0640*0.7;  
lilv_array[40][2][5]=0.0375; 
lilv_array[40][2][10]=0.0430; 

//2010��	12��26����������(85��)
lilv_array[41]=new Array;
lilv_array[41][1]=new Array;
lilv_array[41][2]=new Array;
lilv_array[41][1][5]=0.0622*0.85; 
lilv_array[41][1][10]=0.0640*0.85;  
lilv_array[41][2][5]=0.0375; 
lilv_array[41][2][10]=0.0430;

//2010��	12��26�ջ�׼����
lilv_array[42]=new Array;
lilv_array[42][1]=new Array;
lilv_array[42][2]=new Array;
lilv_array[42][1][5]=0.0622;//�̴� 1��5�� 5.96%
lilv_array[42][1][10]=0.0640;//�̴� 5-30�� 6.14%
lilv_array[42][2][5]=0.0375;//������ 1��5�� 3.50%
lilv_array[42][2][10]=0.0430;//������ 5-30�� 4.05%

//2010��	12��26����������(1.1��)
lilv_array[43]=new Array;
lilv_array[43][1]=new Array;
lilv_array[43][2]=new Array;
lilv_array[43][1][5]=0.0622*1.1; 
lilv_array[43][1][10]=0.0640*1.1; 
lilv_array[43][2][5]=0.0375*1.1;
lilv_array[43][2][10]=0.0430*1.1;

//2010��	12��26����������(1.2��)
lilv_array[44]=new Array;
lilv_array[44][1]=new Array;
lilv_array[44][2]=new Array;
lilv_array[44][1][5]=0.0622*1.2; 
lilv_array[44][1][10]=0.0640*1.2; 
lilv_array[44][2][5]=0.0375;
lilv_array[44][2][10]=0.0430;

//2011��	02��09����������(7��)
lilv_array[45]=new Array;
lilv_array[45][1]=new Array;
lilv_array[45][2]=new Array;
lilv_array[45][1][5]=0.0645*0.7;    
lilv_array[45][1][10]=0.0660*0.7;  
lilv_array[45][2][5]=0.0400; 
lilv_array[45][2][10]=0.0450; 

//2011��	02��09����������(85��)
lilv_array[46]=new Array;
lilv_array[46][1]=new Array;
lilv_array[46][2]=new Array;
lilv_array[46][1][5]=0.0645*0.85; 
lilv_array[46][1][10]=0.0660*0.85;  
lilv_array[46][2][5]=0.0400; 
lilv_array[46][2][10]=0.0450;

//2011��	02��09�ջ�׼����
lilv_array[47]=new Array;
lilv_array[47][1]=new Array;
lilv_array[47][2]=new Array;
lilv_array[47][1][5]=0.0645;//�̴� 1��5�� 5.96%
lilv_array[47][1][10]=0.0660;//�̴� 5-30�� 6.14%
lilv_array[47][2][5]=0.0400;//������ 1��5�� 3.50%
lilv_array[47][2][10]=0.0450;//������ 5-30�� 4.05%

//2011��	02��09����������(1.1��)
lilv_array[48]=new Array;
lilv_array[48][1]=new Array;
lilv_array[48][2]=new Array;
lilv_array[48][1][5]=0.0645*1.1; 
lilv_array[48][1][10]=0.0660*1.1; 
lilv_array[48][2][5]=0.0400*1.1;
lilv_array[48][2][10]=0.0450*1.1;

//2011��	02��09����������(1.2��)
lilv_array[49]=new Array;
lilv_array[49][1]=new Array;
lilv_array[49][2]=new Array;
lilv_array[49][1][5]=0.0645*1.2; 
lilv_array[49][1][10]=0.0660*1.2; 
lilv_array[49][2][5]=0.0400;
lilv_array[49][2][10]=0.0450;

//2011��	04��06����������(7��)
lilv_array[50]=new Array;
lilv_array[50][1]=new Array;
lilv_array[50][2]=new Array;
lilv_array[50][1][5]=0.0665*0.7;    
lilv_array[50][1][10]=0.0680*0.7;  
lilv_array[50][2][5]=0.0420; 
lilv_array[50][2][10]=0.0470; 

//2011��	04��06����������(85��)
lilv_array[51]=new Array;
lilv_array[51][1]=new Array;
lilv_array[51][2]=new Array;
lilv_array[51][1][5]=0.0665*0.85; 
lilv_array[51][1][10]=0.0680*0.85;  
lilv_array[51][2][5]=0.0420; 
lilv_array[51][2][10]=0.0470;

//2011��	04��06�ջ�׼����
lilv_array[52]=new Array;
lilv_array[52][1]=new Array;
lilv_array[52][2]=new Array;
lilv_array[52][1][5]=0.0665;//�̴� 1��5�� 5.96%
lilv_array[52][1][10]=0.0680;//�̴� 5-30�� 6.14%
lilv_array[52][2][5]=0.0420;//������ 1��5�� 3.50%
lilv_array[52][2][10]=0.0470;//������ 5-30�� 4.05%

//2011��	04��06����������(1.1��)
lilv_array[53]=new Array;
lilv_array[53][1]=new Array;
lilv_array[53][2]=new Array;
lilv_array[53][1][5]=0.0665*1.1; 
lilv_array[53][1][10]=0.0680*1.1; 
lilv_array[53][2][5]=0.0420*1.1;
lilv_array[53][2][10]=0.0470*1.1;

//2011��	04��06����������(1.2��)
lilv_array[54]=new Array;
lilv_array[54][1]=new Array;
lilv_array[54][2]=new Array;
lilv_array[54][1][5]=0.0665*1.2; 
lilv_array[54][1][10]=0.0680*1.2; 
lilv_array[54][2][5]=0.0420;
lilv_array[54][2][10]=0.0470;


//2011��	07��07����������(7��)
lilv_array[55]=new Array;
lilv_array[55][1]=new Array;
lilv_array[55][2]=new Array;
lilv_array[55][1][5]=0.0690*0.7;    
lilv_array[55][1][10]=0.0705*0.7;  
lilv_array[55][2][5]=0.0445; 
lilv_array[55][2][10]=0.0490; 

//2011��	07��07����������(85��)
lilv_array[56]=new Array;
lilv_array[56][1]=new Array;
lilv_array[56][2]=new Array;
lilv_array[56][1][5]=0.0690*0.85; 
lilv_array[56][1][10]=0.0705*0.85;  
lilv_array[56][2][5]=0.0445; 
lilv_array[56][2][10]=0.0490;

//2011��	07��07����������(9��)
lilv_array[57]=new Array;
lilv_array[57][1]=new Array;
lilv_array[57][2]=new Array;
lilv_array[57][1][5]=0.0690*0.9; 
lilv_array[57][1][10]=0.0705*0.9;  
lilv_array[57][2][5]=0.0445; 
lilv_array[57][2][10]=0.0490;

//2011��	07��07�ջ�׼����
lilv_array[58]=new Array;
lilv_array[58][1]=new Array;
lilv_array[58][2]=new Array;
lilv_array[58][1][5]=0.0690;//�̴� 1��5�� 5.96%
lilv_array[58][1][10]=0.0705;//�̴� 5-30�� 6.14%
lilv_array[58][2][5]=0.0445;//������ 1��5�� 3.50%
lilv_array[58][2][10]=0.0490;//������ 5-30�� 4.05%

//2011��	07��07����������(1.05��)
lilv_array[59]=new Array;
lilv_array[59][1]=new Array;
lilv_array[59][2]=new Array;
lilv_array[59][1][5]=0.0690*1.05; 
lilv_array[59][1][10]=0.0705*1.05; 
lilv_array[59][2][5]=0.0445*1.05;
lilv_array[59][2][10]=0.0490*1.05;

//2011��	07��07����������(1.1��)
lilv_array[60]=new Array;
lilv_array[60][1]=new Array;
lilv_array[60][2]=new Array;
lilv_array[60][1][5]=0.0690*1.1; 
lilv_array[60][1][10]=0.0705*1.1; 
lilv_array[60][2][5]=0.0445*1.1;
lilv_array[60][2][10]=0.0490*1.1;

//2011��	07��07����������(1.2��)
lilv_array[61]=new Array;
lilv_array[61][1]=new Array;
lilv_array[61][2]=new Array;
lilv_array[61][1][5]=0.0690*1.2; 
lilv_array[61][1][10]=0.0705*1.2; 
lilv_array[61][2][5]=0.0445*1.2;
lilv_array[61][2][10]=0.0490*1.2;

//2012��	06��08����������(7��)
lilv_array[62]=new Array;
lilv_array[62][1]=new Array;
lilv_array[62][2]=new Array;
lilv_array[62][1][5]=0.0665*0.7;    
lilv_array[62][1][10]=0.0680*0.7;  
lilv_array[62][2][5]=0.0420; 
lilv_array[62][2][10]=0.0470; 

//2012��	06��08����������(85��)
lilv_array[63]=new Array;
lilv_array[63][1]=new Array;
lilv_array[63][2]=new Array;
lilv_array[63][1][5]=0.0665*0.85; 
lilv_array[63][1][10]=0.0680*0.85;  
lilv_array[63][2][5]=0.0420; 
lilv_array[63][2][10]=0.0470;

//2012��	06��08����������(9��)
lilv_array[64]=new Array;
lilv_array[64][1]=new Array;
lilv_array[64][2]=new Array;
lilv_array[64][1][5]=0.0665*0.9; 
lilv_array[64][1][10]=0.0680*0.9;  
lilv_array[64][2][5]=0.0420; 
lilv_array[64][2][10]=0.0470;

//2012��	06��08�ջ�׼����
lilv_array[65]=new Array;
lilv_array[65][1]=new Array;
lilv_array[65][2]=new Array;
lilv_array[65][1][5]=0.0665;//�̴� 1��5�� 5.96%
lilv_array[65][1][10]=0.0680;//�̴� 5-30�� 6.14%
lilv_array[65][2][5]=0.0420;//������ 1��5�� 3.50%
lilv_array[65][2][10]=0.0470;//������ 5-30�� 4.05%

//2012��	06��08����������(1.05��)
lilv_array[66]=new Array;
lilv_array[66][1]=new Array;
lilv_array[66][2]=new Array;
lilv_array[66][1][5]=0.0665*1.05; 
lilv_array[66][1][10]=0.0680*1.05; 
lilv_array[66][2][5]=0.0420*1.05;
lilv_array[66][2][10]=0.0470*1.05;

//2012��	06��08����������(1.1��)
lilv_array[67]=new Array;
lilv_array[67][1]=new Array;
lilv_array[67][2]=new Array;
lilv_array[67][1][5]=0.0665*1.1; 
lilv_array[67][1][10]=0.0680*1.1; 
lilv_array[67][2][5]=0.0420*1.1;
lilv_array[67][2][10]=0.0470*1.1;

//2012��	06��08����������(1.2��)
lilv_array[68]=new Array;
lilv_array[68][1]=new Array;
lilv_array[68][2]=new Array;
lilv_array[68][1][5]=0.0665*1.2; 
lilv_array[68][1][10]=0.0680*1.2; 
lilv_array[68][2][5]=0.0420*1.2;
lilv_array[68][2][10]=0.0470*1.2;

//�õ�����
function getlilv(lilv_class,type,years){
	var lilv_class = parseInt(lilv_class);
    if (years<=5){
		 return lilv_array[lilv_class][type][5];
	}else{
		return lilv_array[lilv_class][type][10];
	}
}

//���𻹿���»����(����: ������ / �����ܶ� / �������·� / ���ǰ��0��length-1)
function getMonthMoney2(lilv,total,month,cur_month){
	var lilv_month = lilv / 12;//������
	//return total * lilv_month * Math.pow(1 + lilv_month, month) / ( Math.pow(1 + lilv_month, month) -1 );
	var benjin_money = total/month;
	return (total - benjin_money * cur_month) * lilv_month + benjin_money;

}


//��Ϣ������»����(����: ������/�����ܶ�/�������·�)
function getMonthMoney1(lilv,total,month){
	var lilv_month = lilv / 12;//������
	return total * lilv_month * Math.pow(1 + lilv_month, month) / ( Math.pow(1 + lilv_month, month) -1 );
}

function ext_total(fmobj){
	//var fmobj=document.calc1;
	//������»�����������
	while ((k=fmobj.month_money2.length-1)>=0){
		fmobj.month_money2.options.remove(k);
	}
	var years = fmobj.years.value;
	var month = fmobj.years.value * 12;

	fmobj.month1.value = month+"(��)";
	fmobj.month2.value = month+"(��)";
	if (fmobj.type.value == 3 ){
		//--  ����ʹ���(����ʹ���ļ��㣬ֻ����ҵ�����͹����������йأ��Ͱ������ܶ�����޹�)
			if (!reg_Num(fmobj.total_sy.value)){alert("����ʹ�������д�̴�����");fmobj.total_sy.focus();return false;}
			if (!reg_Num(fmobj.total_gjj.value)){alert("����ʹ�������д���������");fmobj.total_gjj.focus();return false;}
			if (fmobj.total_sy.value==null){fmobj.total_sy.value=0;}
			if (fmobj.total_gjj.value==null){fmobj.total_gjj.value=0;}
			var total_sy = fmobj.total_sy.value*10000;
			var total_gjj = fmobj.total_gjj.value*10000;
			fmobj.fangkuan_total1.value = "��";//�����ܶ�
			fmobj.fangkuan_total2.value = "��";//�����ܶ�
			fmobj.money_first1.value = 0;//���ڸ���
			fmobj.money_first2.value = 0;//���ڸ���

			//�����ܶ�
			var total_sy = parseInt(fmobj.total_sy.value*10000);
			var total_gjj = parseInt(fmobj.total_gjj.value*10000);
			var daikuan_total = total_sy + total_gjj;
			fmobj.daikuan_total1.value = Math.round(daikuan_total);
			fmobj.daikuan_total2.value = Math.round(daikuan_total);

			//�»���
			var lilv_sd = getlilv(fmobj.lilv.value,1, years);//�õ��̴�����
			var lilv_gjj = getlilv(fmobj.lilv.value,2, years);//�õ�����������

			//1.���𻹿�
				//�»���
				var all_total2 = 0;
				var month_money2 = "";
				for(j=0;j<month;j++) {
					//���ú�������: �����»����
					huankuan = getMonthMoney2(lilv_sd,total_sy,month,j) + getMonthMoney2(lilv_gjj,total_gjj,month,j);
					all_total2 += huankuan;
					huankuan = Math.round(huankuan*100)/100;
					//fmobj.month_money2.options[j] = new Option( (j+1) +"��," + huankuan + "(Ԫ)", huankuan);
					month_money2 += (j+1) +"��," + huankuan + "(Ԫ)\n";
				}
				fmobj.month_money2.value = month_money2;
				//�����ܶ�
				fmobj.all_total2.value = Math.round(all_total2*100)/100;
				//֧����Ϣ��
				fmobj.accrual2.value = Math.round( (all_total2 - daikuan_total) *100)/100;


			//2.��Ϣ����
				//�¾�����
				var month_money1 = getMonthMoney1(lilv_sd,total_sy,month) + getMonthMoney1(lilv_gjj,total_gjj,month);//���ú�������
				fmobj.month_money1.value = Math.round(month_money1*100)/100 + "(Ԫ)";
				//�����ܶ�
				var all_total1 = month_money1 * month;
				fmobj.all_total1.value = Math.round(all_total1*100)/100;
				//֧����Ϣ��
				fmobj.accrual1.value = Math.round( (all_total1 - daikuan_total) *100)/100;

	}else{
		//--  ��ҵ������������
			var lilv = getlilv(fmobj.lilv.value,fmobj.type.value, fmobj.years.value);//�õ�����
			if (fmobj.jisuan_radio[0].checked == true){
				//------------ ���ݵ����������
				if (!reg_Num(fmobj.price.value)){alert("����д����");fmobj.price.focus();return false;}
				if (!reg_Num(fmobj.sqm.value)){alert("����д���");fmobj.sqm.focus();return false;}

				//�����ܶ�
				var fangkuan_total = fmobj.price.value * fmobj.sqm.value;
				fmobj.fangkuan_total1.value = fangkuan_total;
				fmobj.fangkuan_total2.value = fangkuan_total;
				//�����ܶ�
				var daikuan_total = (fmobj.price.value * fmobj.sqm.value) * (fmobj.anjie.value/10);
				fmobj.daikuan_total1.value = Math.round(daikuan_total);
				fmobj.daikuan_total2.value = Math.round(daikuan_total);
				//���ڸ���
				var money_first = fangkuan_total - daikuan_total;
				fmobj.money_first1.value = Math.round(money_first);
				fmobj.money_first2.value = Math.round(money_first);
			}else{
				//------------ ���ݴ����ܶ����
				if (!reg_Num(fmobj.daikuan_total000.value)){alert("����д�����ܶ�");fmobj.daikuan_total000.focus();return false;}

				//�����ܶ�
				fmobj.fangkuan_total1.value = "��";
				fmobj.fangkuan_total2.value = "��";
				//�����ܶ�
				//var daikuan_total = fmobj.daikuan_total000.value;
				var daikuan_total = fmobj.daikuan_total000.value*10000;
				fmobj.daikuan_total1.value = Math.round(daikuan_total);
				fmobj.daikuan_total2.value = Math.round(daikuan_total);
				//���ڸ���
				fmobj.money_first1.value = 0;
				fmobj.money_first2.value = 0;
			}
			//1.���𻹿�
				//�»���
				var all_total2 = 0;
				var month_money2 = "";
				for(j=0;j<month;j++) {
					//���ú�������: �����»����
					huankuan = getMonthMoney2(lilv,daikuan_total,month,j);
					all_total2 += huankuan;
					huankuan = Math.round(huankuan*100)/100;
					//fmobj.month_money2.options[j] = new Option( (j+1) +"��," + huankuan + "(Ԫ)", huankuan);
					month_money2 += (j+1) +"��," + huankuan + "(Ԫ)\n";
				}
				fmobj.month_money2.value = month_money2;
				//�����ܶ�
				fmobj.all_total2.value = Math.round(all_total2*100)/100;
				//֧����Ϣ��
				fmobj.accrual2.value = Math.round( (all_total2 - daikuan_total) *100)/100;


			//2.��Ϣ����
				//�¾�����
				var month_money1 = getMonthMoney1(lilv,daikuan_total,month);//���ú�������
				fmobj.month_money1.value = Math.round(month_money1*100)/100 + "(Ԫ)";
				//�����ܶ�
				var all_total1 = month_money1 * month;
				fmobj.all_total1.value = Math.round(all_total1*100)/100;
				//֧����Ϣ��
				fmobj.accrual1.value = Math.round( (all_total1 - daikuan_total) *100)/100;

	}
}