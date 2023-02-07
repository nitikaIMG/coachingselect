<table cellspacing="0" cellpadding="0" dir="ltr" border="1" style="table-layout:fixed;font-size:10pt;font-family:Calibri;border-collapse:collapse;border:none" id="content">
   <colgroup>
      <col width="88">
      <col width="256">
      <col width="46">
      <col width="125">
      <col width="14">
      <col width="70">
      <col width="42">
      <col width="105">
      <col width="107">
   </colgroup>
   <tbody>
      <tr style="height:15px">
         <td style="border:1px solid rgb(0,0,0);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:Arial;font-size:8pt;font-weight:bold;text-align:center" rowspan="1" colspan="9">TAX INVOICE</td>
      </tr>
      <tr style="height:110px">
         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0);overflow:hidden;padding:0px 3px;vertical-align:top;text-align:center;position: relative;" rowspan="1" colspan="9">
            <span style="color:rgb(84,59,98);font-family:Arial;font-size:19pt;font-weight:bold">CoachingSelect<br></span><span style="color:rgb(84,59,98);font-family:Arial;font-size:10pt;font-weight:bold">GSTIN -: 08AQFPG3517P1ZK                                                                                                                              <br></span><span style="color:rgb(0,0,0);font-family:Arial;font-size:8pt"> UAM No. RJ14D0193750</span><br><span style="color:rgb(0,0,0);font-family:Arial;font-size:8pt">Bhamashah Techno Hub,Jhalana Gram, Malviya Nagar, Jaipur, Rajasthan 302017</span><br>
            <div style="text-align:left;position: absolute;top: 16px;">&nbsp; &nbsp; 
            <img src="{{ asset('public/website/assets/img/site_logo1.png') }}" alt="image.png" width="150" data-image-whitelisted="" class="CToWUd"><span style="color:rgb(0,0,0);font-family:Arial;font-size:10.6667px"><br></span></div>
         </td>
      </tr>
      <tr style="height:130px">
         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:Arial;font-size:8pt" rowspan="1" colspan="2"><span style="font-size:8pt;font-weight:bold">Detail of Receiver (Bill to)<br>Bill To: {{ $my_purchase->student_name ?? '' }}</span><span style="font-size:8pt"><br></span><span style="font-size:8pt;font-weight:bold">Address: {{ $my_purchase->address1 ?? '' }}</span><span style="font-size:8pt"><br></span><span style="font-size:8pt;font-weight:bold">GSTIN :<br>State: {{ $my_purchase->st_state ?? '' }}<br>Code:</span>
         </td>

         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0) rgb(204,204,204);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:Arial;font-size:8pt;font-weight:bold" rowspan="1" colspan="4">Detail of Consignee (Ship to)<br>Ship to: {{ $my_purchase->student_name ?? '' }}<br>Address: {{ $my_purchase->address1 ?? '' }}<br>GSTIN :<br>State: {{ $my_purchase->st_state ?? '' }}<br>Code: 
         </td>
         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0) rgb(204,204,204);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:Arial;font-size:8pt;font-weight:bold" rowspan="1" colspan="3"><span style="font-size:8pt">Invoice No: {{ $my_purchase->invoice_number ?? '' }}<br>Date: {{ $my_purchase->cdate ?? '' }}<br>State: </span><span style="font-size:8pt;font-weight:normal">Rajasthan</span><span style="font-size:8pt"><br>Code: </span><span style="font-size:8pt;font-weight:normal">08</span>
         </td>
      </tr>
      <tr style="height:17px">
         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:Arial;font-size:9pt;font-weight:bold;text-align:center">Sr. No.</td>
         <td style="text-align:center;border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0) rgb(204,204,204);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:Arial;font-size:9pt;font-weight:bold" rowspan="1" colspan="2">Description Of Service</td>
         <td style="text-align:center;border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0) rgb(204,204,204);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:Arial;font-size:9pt;font-weight:bold" rowspan="1" colspan="2">HSN / SAC</td>
         <td style="text-align:center;border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0) rgb(204,204,204);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:Arial;font-size:9pt;font-weight:bold" rowspan="1" colspan="2">Quantity</td>
         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0) rgb(204,204,204);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:Arial;font-size:9pt;font-weight:bold;text-align:center">Rate</td>
         <td style="text-align:center;border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0) rgb(204,204,204);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:Arial;font-size:9pt;font-weight:bold">Amount</td>
      </tr>
      <tr style="height:17px">
         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:Arial;font-size:9pt;color:rgb(0,0,0);text-align:center">1</td>
         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0) rgb(204,204,204);overflow:hidden;padding:0px 3px;vertical-align:top" rowspan="1" colspan="2">
            {{ $my_purchase->course_name ?? '' }} ( {{ $my_purchase->coaching_name ?? '' }} )
         </td>
         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0) rgb(204,204,204);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:Arial;font-size:8pt;color:rgb(0,0,0);text-align:center" rowspan="1" colspan="2">999299</td>
         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0) rgb(204,204,204);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:Arial;font-size:9pt;color:rgb(0,0,0);text-align:center" rowspan="1" colspan="2">1</td>
         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0) rgb(204,204,204);overflow:hidden;padding:0px 3px;vertical-align:top">
            {{ $my_purchase->total_price ?? '' }}
         </td>
         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0) rgb(204,204,204);overflow:hidden;padding:0px 3px;vertical-align:top">
            {{ $my_purchase->total_price ?? '' }}
         </td>
      </tr>
      <tr style="height:297px">
         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0);overflow:hidden;padding:0px 3px;vertical-align:top" rowspan="1" colspan="9"></td>
      </tr>
      <tr style="height:104px">
         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:Arial;font-size:9pt" rowspan="1" colspan="4"><span style="font-size:9pt;font-weight:bold">Bank Details for NEFT/RTGS<br></span><span style="font-size:9pt">Account Name : Coaching Select<br>Current A/C No. : 3896837605 <br>IFSC Code : CBIN0281478<br>Bank Name : Central Bank of India<br>Branch Name : Tonk Road, Jaipur<br><br></span></td>
         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0) rgb(204,204,204);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:Arial;font-size:9pt" rowspan="1" colspan="5"><span style="font-size:9pt">
         Total :  {{ $my_purchase->total ?? '' }}<br>

         @if($my_purchase->st_state == 'Rajasthan')
            CGST @9.0 % : {{ $my_purchase->half_gst ?? '' }}<br>
            SGST @9.0 % : {{ $my_purchase->half_gst ?? '' }}<br>
         @else
            IGST @18.0 % :  {{ $my_purchase->full_gst ?? '' }}<br>
         @endif
         </span><span style="font-size:9pt;font-weight:bold">
         Grand Total : {{ $my_purchase->total_price ?? '' }}                                   </span></td>
      </tr>
      <tr style="height:19px">
         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:Arial;font-size:8pt;font-weight:bold" rowspan="1" colspan="9">Amount In Words:</td>
      </tr>
      <tr style="height:80px">
         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:Arial;font-size:8pt" rowspan="1" colspan="9">
            <span style="font-size:8pt">1. PAN NO: AQFPG3517P                                                                                                                                                                                                                <br>2. Payment once made will not be refunded.                                                                                                         </span><span style="font-size:8pt;font-weight:bold">                                                                                          <br></span>
            <span style="font-size:8pt">
               3. All Rights Reserved to CoachingSelect.<br>4. Any Dispute is subject to Jaipur jurisdiction only.<br>
               <div style="text-align:center">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img src="{{ asset('public/authrise_sign.png') }}" alt="image.png" width="64" height="31" style="font-size:8pt" data-image-whitelisted="" class="CToWUd"></div>
            </span>
            <span style="font-size:8pt">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Authorised Signatory<br><br></span>
         </td>
      </tr>
      <tr style="height:17px">
         <td style="border-width:1px;border-style:solid;border-color:rgb(204,204,204) rgb(0,0,0) rgb(0,0,0);overflow:hidden;padding:0px 3px;vertical-align:top;font-family:&quot;Times New Roman&quot;;color:rgb(0,0,0);text-align:center" rowspan="1" colspan="9">Mobile: +91-9636786126  | Email: <a href="mailto:Support@coachingselect.com" target="_blank">Support@coachingselect.com</a>&nbsp;</td>
      </tr>
   </tbody>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="{{ asset('public/website/assets/html2pdf.bundle.min.js') }}"></script>

<script type="text/javascript">
function saveAspdf(){
   var modalscorecardshtml= $("#content").html();
         html2pdf()
            .from(modalscorecardshtml)
            .save('invoice');
}

if( window.location.href.toString().includes('download_invoice') ) {
   // saveAspdf();
}
</script>