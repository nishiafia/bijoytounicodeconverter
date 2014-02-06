function converttext(){
	
        // $('#uploadIFrame').contents().find("body p").addClass("Value from parent file.");
		


		var t="bangla";
		
		//  Wordpress Post Title
		
		var w=document.getElementById('title').value;
                var content1=document.getElementById('content').value;
                w=cM(t,w);
                content1=cM(t,content1);
              //  alert(w);
                   // alert(content1);
		//document.getElementById('title').value='';
                document.getElementById('content').value='';
               document.getElementById('title').value=w;
          //   document.getElementById('content').value=content1;
		 ag(document.getElementById('content'),content1);
               
	

	

          //  Wordpress Top Sub
		//$('#acf-field-top_sub').bind("change",function(){
		var top_sub=document.getElementById('acf-field-top_sub').value;
		//alert(content1);
		top_sub=cM(t,top_sub);
		document.getElementById('acf-field-top_sub').value=top_sub;
		//ag(document.getElementById('acf-field-top_sub'),top_sub);
		//});

         //  Wordpress acf-field-bottom_sub
		//$('#acf-field-bottom_sub').bind("change",function(){
		var bottom_sub=document.getElementById('acf-field-bottom_sub').value;
		//alert(content1);
		bottom_sub=cM(t,bottom_sub);
		document.getElementById('acf-field-bottom_sub').value=bottom_sub;
		//ag(document.getElementById('acf-field-bottom_sub'),bottom_sub);
		//});

 //  Wordpress acf-field-reporter
		//$('#acf-field-reporter').bind("change",function(){
		var reporter=document.getElementById('acf-field-reporter').value;
		//alert(content1);
		reporter=cM(t,reporter);
		document.getElementById('acf-field-reporter').value=reporter;
		//ag(document.getElementById('acf-field-reporter'),reporter);
		//});


	 
	//	wp_mce_fullscreen
}
