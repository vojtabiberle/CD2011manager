<?php
/****************************************************************
* Script         : PHP Simple Excel File Generator - Base Class
* Project        : PHP SimpleXlsGen
* Author         : Erol Ozcan <eozcan@superonline.com>
* Version        : 0.1
* Copyright      : GNU LGPL
* URL            : http://psxlsgen.sourceforge.net
* Last modified  : 17 May 2001
* Desciption     : This class is used to generate very simple
*   MS Excel file (xls) via PHP.
*   The generated xls file can be obtained by web as a stream
*   file or can be written under $default_dir path. This package
*   is also included mysql, pgsql, oci8 database interaction to
*   generate xls files.
*   Limitations:
*    - Max character size of a text(label) cell is 255
*    ( due to MS Excel 5.0 Binary File Format definition )
*
* Credits        : This class is based on Christian Novak's small
*    Excel library functions.
******************************************************************/
if( !defined( "PHP_SIMPLE_XLS_GEN" ) ) {
   define( "PHP_SIMPLE_XLS_GEN", 1 );
   class  PhpSimpleXlsGen {
      var  $xls_data   = "";      // where generated xls be stored
      var  $default_dir = "";
      var  $filename  = "psxlsgen";       // save filename
      var  $fname    = "";        // filename with full path
      var  $crow     = 0;         // current row number
      var  $ccol     = 0;         // current column number
      var  $totalcol = 0;         // total number of columns
      var  $get_type = 0;         // 0=stream, 1=file
      var  $errno    = 0;         // 0=no error
      var  $error    = "";        // error string
      var  $dirsep   = "/";       // directory separator
      var  $xls_stName = "Erol �zcan";

     // Default constructor
     function  PhpSimpleXlsGen()
     {
       $os = getenv( "OS" );
       $temp = getenv( "TEMP");
       // check OS and set proper values for some vars.
       if ( stristr( $os, "Windows" ) ) {
          $this->default_dir = $temp;
          $this->dirsep = "\\";
       } else {
         // assume that is Unix/Linux
         $this->default_dir = "/tmp";
         $this->dirsep =  "/";
       }
       // begin of the excel file header
       $this->xls_data = pack( "ssssss", 0x809, 0x08, 0x00,0x10, 0x0, 0x0 );
       // WRITEACCESS: Write Access User Name
/*
       $name = str_pad( $this->xls_stName, 111, " " );
       $this->xls_data .= pack( "ss", 0x5c,0x70 );
       $this->xls_data .= pack( "C", 10 );
       $this->xls_data .= $name;
*/
     }
     // end of the excel file
     function End()
     {
       $this->xls_data .= pack( "ss", 0x0A, 0x00 );
       return;
     }

     // write a Number (double) into row, col
     function WriteNumber_pos( $row, $col, $value )
     {
        $this->xls_data .= pack( "sssss", 0x0203, 14, $row, $col, 0x00 );
        $this->xls_data .= pack( "d", $value );
        return;
     }

     // write a label (text) into Row, Col
     function WriteText_pos( $row, $col, $value )
     {
        $len = strlen( $value );
        $this->xls_data .= pack( "s*", 0x0204, 8 + $len, $row, $col, 0x00, $len );
        $this->xls_data .= $value;
        return;
     }
     // insert a number, increment row,col automatically
     function InsertNumber( $value )
     {
        if ( $this->ccol == $this->totalcol ) {
           $this->ccol = 0;
           $this->crow++;
        }
        $this->WriteNumber_pos( $this->crow, $this->ccol, &$value );
        $this->ccol++;
        return;
     }

     // insert a number, increment row,col automatically
     function InsertText( $value )
     {
        if ( $this->ccol == $this->totalcol ) {
           $this->ccol = 0;
           $this->crow++;
        }
        $this->WriteText_pos( $this->crow, $this->ccol, &$value );
        $this->ccol++;
        return;
     }
     // Change position of row,col
     function ChangePos( $newrow, $newcol )
     {
        $this->crow = $newrow;
        $this->ccol = $newcol;
        return;
     }
     // new line
     function NewLine()
     {
        $this->ccol = 0;
        $this->crow++;
        return;
     }
     // send generated xls as stream file
     function SendFile( $filename )
     {
        $this->filename = $filename;
        $this->SendFileEx();
     }
     // send generated xls as stream file
     function SendFileEx()
     {
        $this->End();
        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
        header ( "Cache-Control: no-cache, must-revalidate" );
        header ( "Pragma: no-cache" );
        header ( "Content-type: application/x-msexcel" );
        header ( "Content-Disposition: attachment; filename=$this->filename.xls" );
        header ( "Content-Description: PHP Generated XLS Data" );
        print $this->xls_data;
     }
     // change the default saving directory
     function ChangeDefaultDir( $newdir )
     {
       $this->default_dir = $newdir;
       return;
     }
     // Save generated xls file
     function SaveFile( $filename )
     {
        $this->filename = $filename;
        $this->SaveFileEx();
     }
     // Save generated xls file
     function SaveFileEx()
     {
        $this->End();
        $this->fname = $this->default_dir."$this->dirsep".$this->filename;
        if ( !stristr( $this->fname, ".xls" ) ) {
          $this->fname .= ".xls";
        }
        $fp = fopen( $this->fname, "wb" );
        fwrite( $fp, $this->xls_data );
        fclose( $fp );
        return;
     }

     function GetXls( $type = 0 ) {
         if ( !$type && !$this->get_type ) {
            $this->SendFileEx();
         } else {
            $this->SaveFileEx();
         }

     }

   } // end of the class PHP_SIMPLE_XLS_GEN
}
// end of ifdef PHP_SIMPLE_XLS_GEN