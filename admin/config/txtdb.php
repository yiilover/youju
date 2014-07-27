<?php
class TxtDB //�ı����ݿ��� 
{ 
    var $name=''; //�ı����ݿ��� 
    var $path=''; //���ݿ�·�� 
    var $isError; //������� 
    var $dbh; //�����ļ�dbfָ�� 
    var $indxh; //�����ļ�indxָ�� 
    var $lfth; //���ÿռ��ļ�leftָ�� 
    var $lckh; 
    var $rcdCnt=0;//���ݿ�ļ�¼���� 
    var $maxID=0; //���ݿ��ѷ�������ID��� 
    var $leftCnt=0;//���ÿռ���� 
    var $DBend=0; //DBF�ļ�ĩ��ָ�� 

    /*��ʼ������*/ 

    function TxtDB($name,$path='admin/config/data') 
    { 
        $this->name=$name; 
        $this->path=$path.'/'.$name; 
        $this->isError=0; 
        $path=$this->path; 
        if ($name!='') 
        { 
            @mkdir($this->path,0777);//�������ݿ�Ŀ¼ 

            //����������ݿ��ļ� 
            if (!file_exists($path.'/'.$name.'.tdb')) $this->dbh=fopen($this->path.'/'.$name.'.tdb','w+'); 
            else $this->dbh=fopen($path.'/'.$name.'.tdb','r+'); 
            if (!file_exists($path.'/'.$name.'.indx')) $this->indxh=fopen($this->path.'/'.$name.'.indx','w+'); 
            else $this->indxh=fopen($path.'/'.$name.'.indx','r+'); 
            if (!file_exists($path.'/'.$name.'.lft')) $this->lfth=fopen($this->path.'/'.$name.'.lft','w+'); 
            else $this->lfth=fopen($this->path.'/'.$name.'.lft','r+'); 

            //Ϊ��֤���ݿ������ԭ���ԣ������ݽ��м������� 
            $this->lckh=fopen($this->path.'/'.$name.'.lck','w'); 
            flock($this->lckh,2); 
            fwrite($this->lckh,'lck');//���������������̶����ݿ�Ĳ��в��� 

            //��ȡ���ݿ�������Ϣ 
            $rcd=$this->getRcd(0);//��indx�ļ��ж�ȡ�׸���¼ 
            $this->rcdCnt=$rcd['id']; 
            $this->maxID=$rcd['loc']; 
            $this->DBend=$rcd['len']; 
            $rcd=$this->getLeft(0);//��left�ļ��ж�ȡ�׸���¼ 
            $this->leftCnt=$rcd['loc']; 
        } 
        else $this->isError=1; 
    } 

    /*����indx�Ķ�λ��Ϣ*/ 

    function setRcd($rid,$id,$loc,$len) 
    { 
        fseek($this->indxh,$rid*12); 
        //�ƶ��ļ�ָ������¼�� 
        $str=pack('III',$id,$loc,$len); 
        //������ѹ�����ַ����� 
        fwrite($this->indxh,$str,12); 
        //������λ��Ϣ ID|LOC|Len д��indx�ĵ�rid����¼ 
    } 

    /*��ȡ��λ��Ϣ*/ 
    function getRcd($rid) 
    { 
        fseek($this->indxh,$rid*12); 
        //������¼�� 
        $str=fread($this->indxh,12); 
        //��ȡ��¼ 
        $rcd=array(); 
        //��ѹ�����ַ�����ԭΪ���� 
        $rcd['id']=str2int($str); 
        $rcd['loc']=str2int(substr($str,4,4)); 
        $rcd['len']=str2int(substr($str,8,4)); 
        return $rcd;//���ص�rid����¼�Ķ�λ��Ϣ 
    } 

    /*�������ÿռ��¼*/ 
    function setLeft($lid,$loc,$len) 
    { 
        fseek($this->lfth,$lid*8); 
        $str=pack('II',$loc,$len); 
        fwrite($this->lfth,$str,8); 
    } 

    /*��ȡ��lid�����ÿռ���Ϣ*/ 
    function getLeft($lid) 
    { 
        fseek($this->lfth,$lid*8); 
        $str=fread($this->lfth,8); 
        $rcd['loc']=str2int($str); 
        $rcd['len']=str2int(substr($str,4,4)); 
        return $rcd; 
    } 

    /*�������ݿ�������ͷ����ݼ���*/ 
    function close() 
    { 
        @fclose($this->dbh); 
        @fclose($this->indxh); 
        @fclose($this->lfth); 
        @fclose($this->lckh); 
    } 

    /*�����ÿռ���Ѱ��һ����С����Ϊlen�Ŀռ� 
    ʹ��������÷� */ 
    function seekSpace($len) 
    { 
        $res=array('loc'=>0,'len'=>0); 
        if ($this->leftCnt<1) return $res; 
        //û�����ÿռ� 
        $find=0; 
        $min=1000000; 
        //�����������ÿռ���Ϣ 
        for ($i=$this->leftCnt;$i>0;$i--) 
        { 
            $res=$this->getLeft($i); 
            //��Ѱ����С�պú��ʵĿռ� 
            if ($res['len']==$len) {$find=$i;break;} 
            //�ҵ����õ����ÿռ� 
            else if($res['len']>$len) 
            { 
                //��ͼ�ҵ�һ������ʵĿռ� 
                if ($res['len']-$len<$min) 
                { 
                    $min=$res['len']-$len; 
                    $find=$i; 
                } 
            } 
        } 
        if ($find) 
        { 
            //�ҵ��˺��ʵ����ÿռ� 
            //��ȡ���ÿռ���Ϣ 
            $res=$this->getLeft($find); 

            //��left�ļ�ɾ�������ÿռ�ļ�¼��Ϣ 
            fseek($this->lfth,($find+1)*8); 
            $str=fread($this->lfth,($this->leftCnt-$find)*8); 
            fseek($this->lfth,$find*8); 
            fwrite($this->lfth,$str); 

            //�������ÿռ��¼�� 
            $this->leftCnt--; 
            $this->setLeft(0,$this->leftCnt,0); 

            //���ػ�õ����ÿռ��� 
            return $res; 
        } 
        else //ʧ�ܷ��� 
        { 
            $res['len']=0; 
            return $res; 
        } 
    } 


    /*�����¼�����ݿ�contentΪ��¼����,len�޶���¼�ĳ���*/ 
    function insert($content,$len=0) 
    { 
        $res=array('loc'=>0); 
        //��¼����û��ָ�����������ʵ�ʳ���ָ�� 
        if (!$len) $len=strlen($content);  

        //��ͼ�����ÿռ��л�ȡһ����õĿռ� 
        if ($this->leftCnt) $res=$this->seekSpace($len); 
        if (!$res['len']) 
        { 
            //û���ҵ����õ����ÿռ���������ļ�ĩ�˷���ռ� 
            $res['loc']=$this->DBend; 
            $res['len']=$len; 
        } 

        //���������ļ�ĩ��ָ�� 
        if ($res['loc']+$res['len']>$this->DBend) $this->DBend=$res['loc']+$res['len']; 

        $this->maxID++;//�������ID��� 
        $this->rcdCnt++;//�������ݿ��¼���� 
        //����������д�����ݿ� 
        $this->setRcd(0,$this->rcdCnt,$this->maxID,$this->DBend); 
        $this->setRcd($this->rcdCnt,$this->maxID,$res['loc'],$res['len']); 

        //��ʵ������д���dbf����Ŀռ䴦 
        fseek($this->dbh,$res['loc']); 
        fwrite($this->dbh,$content,$len); 
        //�ɹ������¼�¼�ı�� 
        return $this->maxID; 
    } 

    /*Ѱ�ұ��ΪID�ļ�¼�����ݿ��е�λ�ñ��N*/ 
    /*��ΪID�����indx���������п�ʹ�ö��ֲ��Ҵ����߲�ѯ�ٶ�*/ 
    function findByID($id) 
    { 
        //���ݿ���û�м�¼���߱�ų�����ǰ���ID��� 
        if ($id<1 or $id>$this->maxID or $this->rcdCnt<1) return 0; 

        $left=1; 
        $right=$this->rcdCnt; 
        while($left<$right)//ʵʩ���ֲ��� 
        { 
            $mid=(int)(($left+$right)/2); 
            if ($mid==$left or $mid==$right) break; 
            $rcd=$this->getRcd($mid); 
            if ($rcd['id']==$id) return $mid; 
            else if($id<$rcd['id']) $right=$mid; 
            else $left=$mid; 
        } 
        $rcd=$this->getRcd($left); 
        if ($rcd['id']==$id) return $left; 
        $rcd=$this->getRcd($right); 
        if ($rcd['id']==$id) return $right; 
        //���ҳɹ�����λ�ñ��N 
        return 0;//ʧ�ܷ���0 
    } 

    /*�����ݿ���ɾ�����ΪID�ļ�¼*/ 
    function delete($id) 
    { 
        //���Ҵ˼�¼�����ݿ��е�λ�ñ�� 
        $rid=$this->findByID($id); 
        if (!$rid) return;//������ID��Ϊid�ļ�¼ 

        $res=$this->getRcd($rid);//��ȡ�˼�¼�Ķ�λ��Ϣ 

        //�������ļ���ɾ���˼�¼�Ķ�λ��Ϣ 
        fseek($this->indxh,($rid+1)*12); 
        $str=fread($this->indxh,($this->rcdCnt-$i)*12); 
        fseek($this->indxh,$rid*12); 
        fwrite($this->indxh,$str); 

        //�������ݿ��¼����������д�����ݿ� 
        $this->rcdCnt--; 
        $this->setRcd(0,$this->rcdCnt,$this->maxID,$this->DBend); 

        //���˼�¼��dbf��ռ�õĿռ�Ǽǵ����ÿռ���� 
        $this->leftCnt++; 
        $this->setLeft(0,$this->leftCnt,0); 
        $this->setLeft($this->leftCnt,$res['loc'],$res['len']); 
    } 

    /*����ID���Ϊid�ļ�¼����*/ 
    /*len���������޶���¼������*/ 
    function update($id,$newcontent,$len=0) 
    { 
        //��ID���ת��Ϊλ�ñ��N 
        $rid=$this->findByID($id); 
        if (!$rid) return;//�����ID��� 

        if (!$len) $len=strlen($newcontent);  

        //��ȡ�˼�¼��λ��Ϣ 
        $rcd=$this->getRcd($rid); 
        //���µ����ݳ��ȳ�����¼ԭ������Ŀռ� 
        if ($rcd['len']<$len) 
        { 
            //����ԭ�ռ䲢���˿ռ�¼�����ÿռ���� 
            $this->leftCnt++; 
            $this->setLeft(0,$this->leftCnt,0); 
            $this->setLeft($this->leftCnt,$rcd['loc'],$rcd['len']); 

            //��dbfĩ��Ϊ�˼�¼���·���ռ� 
            $rcd['loc']=$this->DBend; 
            $rcd['len']=$len; 
            $this->DBend+=$len; 
            //�������ݿ���Ϣ 
            $this->setRcd(0,$this->rcdCnt,$this->maxID,$this->DBend); 
            $this->setRcd($rid,$rcd['id'],$rcd['loc'],$rcd['len']); 
        } 
        //д�������� 
        fseek($this->dbh,$rcd['loc']); 
        fwrite($this->dbh,$newcontent,$len); 
    } 

    /*����λ�ñ�Ż�ȡ��¼����*/ 
    function selectByRid($rid) 
    { 
        //������ID�����ʵ������content��Ԫ�鷵�� 
        $res=array('id'=>0,'content'=>''); 
        //�����λ�ñ�� 
        if ($rid<1 or $rid>$this->rcdCnt) return $res; 
        //��ȡ��λ��Ϣ 
        else $rcd=$this->getRcd($rid); 
        $res['id']=$rcd['id']; 
        $res['len']=$rcd['len']; 
        //���ݶ�λ��Ϣ��dbf�ж�ȡʵ������ 
        fseek($this->dbh,$rcd['loc']); 
        $res['content']=fread($this->dbh,$rcd['len']); 
        return $res; 
    } 

    /*����ID��Ż�ȡ��¼����*/ 
    function select($id) 
    { 
        //��ID���ת����λ�ñ���ٵ�������ĺ��� 
        return $this->selectByRid($this->findByID($id)); 
    } 

    /*���ݿⱸ��*/ 
    function backup() 
    { 
        copy($this->path.'/'.$this->name.'.tdb',$this->path.'/'.$this->name.'.tdb.bck'); 
        copy($this->path.'/'.$this->name.'.indx',$this->path.'/'.$this->name.'.indx.bck'); 
        copy($this->path.'/'.$this->name.'.lft',$this->path.'/'.$this->name.'.lft.bck'); 
    } 

    /*�ӱ����лָ�*/ 
    function recover() 
    { 
        copy($this->path.'/'.$this->name.'.tdb.bck',$this->path.'/'.$this->name.'.tdb'); 
        copy($this->path.'/'.$this->name.'.indx.bck',$this->path.'/'.$this->name.'.indx'); 
        copy($this->path.'/'.$this->name.'.lft.bck',$this->path.'/'.$this->name.'.lft'); 
    } 

    /*������ݿ�*/ 
    function mydrop() 
    {
        @unlink($this->path.'/'.$this->name.'.tdb'); 
        @unlink($this->path.'/'.$this->name.'.indx'); 
        @unlink($this->path.'/'.$this->name.'.lft');  
    } 

    /*������ݿ��¼*/ 
    function myreset() 
    { 
        setRcd(0,0,0); 
        setLeft(0,0); 
    } 
} 

?> 

