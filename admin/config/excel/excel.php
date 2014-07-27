<?php
require AJ_ROOT."/admin/config/excel/excelparser.php";
/**
 * CopyRight (c) 2009,
 * All rights reserved.
 * �ļ���:excel���ݻ�ȡ
 * ժ  Ҫ:
 *
 * @author ���ڰ� [url=mailto:ixqbar@hotmail.com]ixqbar@hotmail.com[/url]
 * @version 0.1
 */
class ExcelParser
{
    private $_data=array(0,'');
    private $_excel_handle;
    private $_excel=array();
    /**
     * ���캯��
     * @param <string> $filename �ϴ��ļ���ʱ�ļ�����
     */
    public function __construct($filename)
    {
        /**
         * ����excelparser��
         * ��ͨ����Ϊ
         * requires ·��.'excelparser.php';
         */
        //import('@.Util.PHPExcelParser.excelparser','','.php');
        $this->_excel_handle=new ExcelFileParser();
        //�����ȡ
        $this->checkErrors($filename);
    }
    /**
     * ����У��
     */
    private function checkErrors($filename)
    {
        /**
         * ����һ
         */
        $error_code=$this->_excel_handle->ParseFromFile($filename);
        /**
         * ������
         * $file_handle = fopen($this->_filename,'rb');
         * $content = fread($file_handle,filesize($this->_filename));
         * fclose($file_handle);
         * $error_code = $this->_excel->ParseFromString($content);
         * unset($content,$file_handle);
         */
        switch($error_code)
        {
            case 0:
                //�޴��󲻴���
                break;
            case 1:
                $this->_data=array(1,'�ļ���ȡ����(Linuxע���дȨ��)');
                break;
            case 2:
                $this->_data=array(1,'�ļ�̫С');
                break;
            case 3:
                $this->_data=array(1,'��ȡExcel��ͷʧ��');
                break;
            case 4:
                $this->_data=array(1,'�ļ���ȡ����');
                break;
            case 5:
                $this->_data=array(1,'�ļ�����Ϊ��');
                break;
            case 6:
                $this->_data=array(1,'�ļ�������');
                break;
            case 7:
                $this->_data=array(1,'��ȡ���ݴ���');
                break;
            case 8:
                $this->_data=array(1,'�汾����');
                break;
        }
        unset($error_code);
    }
    /**
     * Excel��Ϣ��ȡ
     */
    private function getExcelInfo()
    {
        if(1==$this->_data[0])return;
        /**
         * ���sheet����
         * ���sheet��Ԫ��Ӧ���к���
         */
        $this->_excel['sheet_number']=count($this->_excel_handle->worksheet['name']);
        for($i=0;$i<$this->_excel['sheet_number'];$i++)
        {
            /**
             * ������
             * ע��:��0��ʼ����
             */
            $row=$this->_excel_handle->worksheet['data'][$i]['max_row'];
            $col=$this->_excel_handle->worksheet['data'][$i]['max_col'];
            $this->_excel['row_number'][$i]=($row==NULL)?0:++$row;
            $this->_excel['col_number'][$i]=($col==NULL)?0:++$col;
            unset($row,$col);
        }
    }
    /**
     * ���Ĵ�����
     * @return <string>
     */
    private function uc2html($str)
    {
        $ret = '';
        for( $i=0; $i<strlen($str)/2; $i++ )
        {
            $charcode = ord($str[$i*2])+256*ord($str[$i*2+1]);
            $ret .= '&#'.$charcode.';';
        }
        return mb_convert_encoding($ret,'GBK','HTML-ENTITIES');
    }
    /**
     * Excel���ݻ�ȡ
     */
    private function getExcelData()
    {
        if(1==$this->_data[0])return;

        //�޸ı��
        $this->_data[0]=1;
        //��ȡ����
        for($i=0;$i<$this->_excel['sheet_number'];$i++)
        {
            /**
             * ����ѭ��
             */
            for($j=0;$j<$this->_excel['row_number'][$i];$j++)
            {
                /**
                 * ����ѭ��
                 */
                for($k=0;$k<$this->_excel['col_number'][$i];$k++)
                {
                    /**
                     * array(4) {
                     *   ["type"]   => ���� [0�ַ�����1����2������3����]
                     *   ["font"]   => ����
                     *   ["data"]   => ����
                     *   ...
                     * }
                     */
                    $data=$this->_excel_handle->worksheet['data'][$i]['cell'][$j][$k];
                    switch($data['type'])
                    {
                        case 0:
                            //�ַ�����
                            if($this->_excel_handle->sst['unicode'][$data['data']])
                            {
                                //���Ĵ���
                                $data['data'] = $this->uc2html($this->_excel_handle->sst['data'][$data['data']]);
                            }
                            else
                            {
                                $data['data'] = $this->_excel_handle->sst['data'][$data['data']];
                            }
                            break;
                        case 1:
                            //����
                            //TODO
                            break;
                        case 2:
                            //������
                            //TODO
                            break;
                        case 3:
                            //����
                            //TODO
                            break;
                    }
                    $this->_data[1][$i][$j][$k]=$data['data'];
                    unset($data);
                }
            }
        }
    }
    /**
     * ������
     * @return <array> array(��ʶ��,����s)
     */
    public function main()
    {
        //Excel��Ϣ��ȡ
        $this->getExcelInfo();
        //Excel���ݻ�ȡ
        $this->getExcelData();
        return $this->_data;
    }
}

?>
