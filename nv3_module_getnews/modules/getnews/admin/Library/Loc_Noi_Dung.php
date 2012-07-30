<?php

/**
 * @author CUONG
 * @copyright 2012
 */
include(NV_ROOTDIR."/modules/".$module_name."/admin/Library/simple_html_dom.php");
class GetContent
{
    static function main($link)
    {
        $html=file_get_html($link);
        $root=$html->find("body",0);
        $a=$root;
        $pos=array();
        $chose=array();
        $b=$root;
        $Title=array();
        $head=array();
        $conten=array();
        
        
        while(count($a->childNodes())>0)
        {
            $nub=GetContent::FindArea($a,$chose);
            $pos[]=$nub;
            $a=$a->children($nub);
        }
        
        $asdf=GetContent::FindAreaConfig($chose,$pos);
        
        foreach($pos as $p)
        {
            $b=$b->children($p);
        }
        
        $tag=array("h1","h2","p");
        
        
        $XpathFull=GetContent::SplitAuto($b,$tag,$Title,$head,$conten,$pos,$root);
        
        //$XpathFull[]=$tieude;
//        $XpathFull[]=$head;
//        $XpathFull[]=$conten;
        
        return $XpathFull;
    }
    
    
    
    
    
    //Hàm này có tác dụng tự động tìm kiếm đoạn text theo từng nội dung như tiêu đề, mô tả và nội dung bài viết.
    static function SplitAuto($b,$tag,&$Title,&$head,&$conten,$pos,$root)
    {
        //Tìm xpath tới tiêu đề
        $tempTitle=$pos;
        $Title=GetContent::FindTitle($tag,$b,$tempTitle);
        $titlePath=GetContent::ArrayToString($Title);
        
        //Tìm Xpath tới mô tả:
        $nodeHead=GetContent::ReturnNode($root,$Title);
        $tieude=$nodeHead->plaintext;
        $head=$Title;
        $head=GetContent::FindHead($nodeHead->parent(),10,$Title[count($Title)-1],$head);
        $headPath=GetContent::ArrayToString($head);
        
        //Tim Xpath tới nội dung:
        $nodeContent=GetContent::ReturnNode($root,$head);
        $mota=$nodeContent->plaintext;
        $conten=$head;
        $conten=GetContent::FindHead($nodeContent->parent(),3,$head[count($head)-1],$conten);
        $contentPath=GetContent::ArrayToString($conten);
         
        $nodeText=GetContent::ReturnNode($root,$conten);
        $noidung=GetContent::GetTextContent($nodeText);
        $XpathFull=array('tieude'=>$tieude,'mota'=>$mota,'noidung'=>$noidung,'titlepath'=>$titlePath,'headpath'=>$headPath,'contentpath'=>$contentPath);
        return $XpathFull;
    }
    
    static function ArrayToString($arr)
    {
        $kq="";
        foreach($arr as $a)
        {
            $kq.=$a.",";
        }
        return $kq;
    }
    
    //Hàm lấy text của phần nội dung
    static function GetTextContent($node)
    {
        $kq="";
        $kq.=$node->outertext();
        while(!is_null($node->nextSibling()))
        {
            $node=$node->nextSibling();
            $kq.=$node->outertext();
        }
        return $kq;
    }
    
    //Hàm tìm mô tả
    static function FindHead($node,$count,&$i,&$head)
    {
        $check=false;//Biến này để lưu kết quả, khi mà tìm thấy vị trí thích hợp có số lượng từ lớn hơn giới hạn thì trả về giá trị true;
        $checkSib=false;//Hàm này để xác định xem node đó có node em cùng cấp hay không.
        $totalChild=count($node->childNodes());//Đếm số con của node truyền vào.
        if($i==$totalChild-1)//Khi mà node đang xét không có node em nào
        {
            array_pop($head);//Loại một phần tử cuối ra khỏi mảng head tương ứng với vị trí node đang xét, để xét tới node cha nó.
            $head=GetContent::FindHead($node->parent(),3,$head[count($head)-1],$head);//Gọi lại hàm tìm mô tả.
        }
        else
        {
            $node=$node->children($i);//Chuyển tới thằng con ở phần tiêu đề đã tìm thấy trong DOM
            while(!is_null($node->nextSibling())&& $i<$totalChild)//Nếu có node con và vị trí node con đang xét nhỏ hơn tổng số node con
            {
                $checkSib=true;//Gán biến này thành true để xác định là nó đang xét node cùng cấp
                //Nếu khi xét biến cùng cấp mà không tìm ra thì sẽ xét node ông của node hiện tại.
                //Nếu khi xét biến không cùng cấp thì sẽ xét tiếp node cha của node hiện tại.
                $nextnode=$node->nextSibling();//Chuyển tới node em
                if(GetContent::CountTotalWord($nextnode->plaintext)>$count)//Đếm số từ của node đó.
                {
                    $i=$i+1;array_pop($head);//Loại bỏ vị trí cuối cùng đang có trong mảng head.
                    $head[]=$i;//Lưu vị trí của đã tìm được vào mảng head.
                    //Khi mà vị trí tìm được vẫn còn node con thì gọi tới hàm A để tìm tới node con thỏa mãn dk hơn.
                    if($nextnode->tag!="table")
                    {
                        $head=GetContent::A($nextnode,$head,$check);
                    }
                    $check=true;//Gán hàm check bằng true và kết thúc vòng lặp.
                    break;
                }
                else
                {
                    //Nếu số từ của node nhỏ hơn điều kiện
                    //Thì gán node=node em và quay lại vòng lặp xét tiếp.
                    $node=$nextnode;
                    $i++;
                }
            }
            //Khi kết thúc vòng lặp mà vẫn không tìm thấy vị trí
            if(!$check)
            {
                //Nếu không xét node cùng cấp
                if(!$checkSib)
                {
                    $i=$head[count($head)-1];//Lấy vị trí của node cha node đang xet trong DOM
                    $node=$node->parent();//Gán node hiện tại bằng node cha
                    $head=GetContent::FindHead($node,$count,$i,$head);//GỌi lại hàm
                }
                else
                {
                    $i=$head[count($head)-1];//Lấy vị trí của node cha node đang xét trong DOM
                    array_pop($head);//Loại bỏ một phần tử cuối ra khỏi mảng head.
                    $node=$node->parent()->parent();//Xét node ông của node hiện tại.
                    $head=GetContent::FindHead($node,$count,$i,$head);//GỌi lại hàm.
                }
            }
        }
        return $head;
    }
    
    //Hàm này được dùng để xét tiếp node đã thỏa mãn điều kiện, tìm tới node con thỏa mãn dk hơn.
    static function A($node,&$head,&$check)
    {
        $i=0;
        $child=$node->childNodes();
        if(count($child)>0)
        {
            foreach($child as $chil)
            {
                
                if($chil->tag=="a" || $chil->tag=="br")//Không xét những node có thẻ tag là a và br.
                {
                    //$chil->innertext="";
                    continue;
                }
                if(GetContent::CountTotalWord($chil->plaintext)>10)
                {
                    if(count($chil->childNodes())>0)//Nếu node đó có con
                    {
                        $head[]=$i;//Thêm vị trí vào mảng head.
                        $head=GetContent::A($chil,$head,$check);//GỌi lại hàm  để xét tiếp.
                    }
                    else
                    {
                        $check=true;//Nếu hết con thì biến check bằng true để kết thúc vòng lặp.
                        $head[]=$i;//Thêm vị trí vào mảng head.
                        break;
                    }
                }
                if(!$check)
                {
                    $i++;
                }
                else break;
            }    
        }
        return $head;
    }
    
    
    //Hàm này được dùng để chuyển mảng xpath thành truy vần tới node cụ thể,
    static function ReturnNode($b,$pos)
    {
        foreach($pos as $p)
        {
            $b=$b->children($p);
        }
        return $b;
    }
    
    //Hàm này dùng để tìm tiêu đề.
    static function FindTitle($tag,$b,$tempTitle)
    {
        //Duyệt mảng các thẻ tag.Nếu tìm thấy node nào trùng với giá trị của mảng thì kết thục luôn.
        foreach($tag as $t)
        {
            $check=false;
            $tempTitle=GetContent::FindXpath($b->childNodes(),$t,$tempTitle,$check);
            if(count($tempTitle)>0)
            {
                break;
            }
        }
        return $tempTitle;
    }
    
    //Hàm này được dùng để tìm ra xpath lưu vào csdl từ một node.
    static function FindXpath($b,$tagName,&$xpath,&$check)
    {
        $i=0;
        foreach($b as $child)
        {
            $xpath[]=$i;//Thêm vị trí vào mảng kết quả
            //Nếu tên tag trùng với giá trị mảng thì kết thúc hàm.
            if($child->tag==$tagName)
            {
                $check=true;
                return $xpath;
            }
            else
            {
                if(!$check)
                {
                    //Nếu mà node còn con thì gọi lại hàm để xét tiếp.
                    if(count($child->childNodes())>0)
                    {
                        GetContent::FindXpath($child->childNodes(),$tagName,$xpath,$check);
                    }
                    //Nếu không sẽ loại bỏ giá trị cuối cùng ra khỏi mảng.
                    else
                    {
                        array_pop($xpath);
                    }
                }
                //Khi biến điều kiện mà sai
                else
                {
                    //Loại bỏ giá trị cuối cùng ra khỏi mảng.
                    array_pop($xpath);
                    break;
                } 
            }
            $i++;
        }
        //Khi kết thúc vòng lặp mà không tìm thấy sẽ loại bỏ giá trị cuối cùng ra khỏi magnr.
        if(!$check)
        {
            array_pop($xpath);
        }
        
        return $xpath;
    }
    
    
    //Hàm này để bước đầu tìm ra khu vực cần lấy.
    static function FindArea($node,&$chose)
    {
        $children=$node->childNodes();
        $count=0;$kq=0;$total=array();$i=0;
        foreach($children as $child)//Duyệt các node con
        {
            //echo $child->tag;
            $count=GetContent::CountTotalWord($child->plaintext);//Đếm số từ lấy được trong node con đó.
            if($count>30)
            {
                array_push($total,$count."@".$i);//Nếu số lượng từ lớn hơn 30, thì cho vào mảng.Mục đích của mảng này là để lưu giữ những node có số từ lớn hơn 30
                //Sau đó tìm ra node có số lượng từ lớn nhất.
            }
            $i++;
        }
        $kq=GetContent::FindMax($total,$chose);
        return $kq;
    }
    
    //Tìm ra vị trí lớn nhất trong mảng
    static function FindMax($arr,&$chose)
    {
        $max=0;$kq=0;
        for($i=0;$i<count($arr);$i++)
        {
            $temp=split("@",$arr[$i]);
            if($max<$temp[0])
            {
                $max=$temp[0];
                $kq=$temp[1];
            }
        }
        $chose[]=$max;
        return $kq;
    }
    
    //Hàm này nhằm chuẩn hóa hơn khu vực cần lấy
    static function FindAreaConfig($chose,&$pos)
    {
        $max=1.3;$vitri=0;
        //Sau khi có được số lượng từ lớn nhất từ các node tổng hợp được ở trên, hệ thống sẽ tìm ra khoảng cách nào có số nhảy cao nhất
        //Khi gặp khoảng cách lớn hơn so với bình thường, lập tức chọn khoảng đó.
        for($i=0;$i<count($chose)-1;$i++)
        {
            if($chose[$i+1]!=0)
            {
                $temp=($chose[$i]/$chose[$i+1]);//Lấy phần nguyên của cái trước chia cho cái sau, nếu nó có bước nhày lớn hơn 1 thì chọn và kết thúc vòng lặp luôn.
                if($max<=$temp)
                {
                    $max=$temp;
                    $vitri=$i;
                    break;
                }
            }
        }
        //Sau khi tìm được vị trí có bước nhảy lớn nhất, loại bỏ khỏi mảng vị trí những giá trị thừa
        //số lượng thừa ở đây chính là bằng số phần tử trong mảng vị trí trừ đi vị trí có bước nhảy lớn đầu tiên.
        $j=count($pos)-$vitri;
        for($z=0;$z<$j-1;$z++)
        {
            array_pop($pos);
        }
        return $pos;
    }
    
    //Đếm ố từ có trong một chuỗi.
    static function CountTotalWord($string)
    {
        $string=ltrim($string);
        $temp=array();
        $temp=split(" ",$string);
        //print_r($temp);
        return count($temp);
    }
}

class GetArea
{
    static function GetContent($link)
    {
        $html=file_get_html($link);
        $a=$html->find("body",0);
        $pos=array();
        $chose=array();
        $b=$a;
        $kq=array();
        while(count($a->childNodes())>0)
        {
            $nub=GetContent::FindArea($a,$chose);
            $pos[]=$nub;
            $a=$a->children($nub);
        }
        
        $asdf=GetContent::FindAreaConfig($chose,$pos);
        foreach($pos as $p)
        {
            $b=$b->children($p);
        }
        
        $tag=array("input","ul","script","font","a","label");
        foreach($tag as $t)
        {
            $node=$b->find($t);
            foreach($node as $no)
            {
                $no->outertext='';
            }
        }
        
        GetArea::RemoveNode($b,$pos);
        $kq['noidung']=$b->outertext();
        $xpath="";
        foreach($pos as $posi)
        {
            $xpath.=$posi."/";
        }
        $kq['xpath']=$xpath;
        return $kq;
     }   
        
     static function RemoveNode(&$b,&$pos)
     {
        $tag=array("h1","h2","p");
        foreach($tag as $t)
        {
            $find=$b->find($t,0);
            if(!is_null($find))
            {
                $totalWord=GetContent::CountTotalWord($find->plaintext);
                $kq=0;
                GetArea::C($find,$totalWord,$kq);
                for($i=0;$i<$kq;$i++)
                {
                    $b=$find->parent();
                    array_pop($pos);
                }
                break;
            }
        }
     }
     
     static function C($node,$totalword,&$kq)
     {
        $child=$node->parent()->childNodes;
        $count=0;
        if(count($child)>0)
        {
            for($i=0;$i<count($child);$i++)
            {
                $nextNode=$node->nextSibling();
                $count.=GetContent::CountTotalWord($nextNode->plaintext);
            }
        }
        if($count<$totalword)
        {
            GetArea::C($node->parent(),$totalword,$kq);
        }
        else
        {
            $kq=1;
        }
     } 
}
?>