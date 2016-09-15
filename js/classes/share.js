var ftShare = function() {};

ftShare.vkontakte = function(purl, ptitle, pimg, text) {
	url  = 'http://vkontakte.ru/share.php?';
	url += 'url='          + encodeURIComponent(purl);
	url += '&title='       + encodeURIComponent(ptitle);
	url += '&description=' + encodeURIComponent(text); /* при большом кол-ве текста глючит */
	url += '&image='       + encodeURIComponent(pimg);
	url += '&noparse=true';
	console.log(encodeURIComponent(purl));
	console.log(encodeURIComponent(ptitle));
	console.log(encodeURIComponent(text));
	console.log(encodeURIComponent(pimg));
	ftShare.popup(url);
	return false;
}
	
ftShare.odnoklassniki = function(purl, text) {
	url  = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1';
	url += '&st.comments=' + encodeURIComponent(text);
	url += '&st._surl='    + encodeURIComponent(purl);
	ftShare.popup(url);
	return false;
}
	
ftShare.facebook = function(purl, ptitle, pimg, text) {
	url  = 'http://www.facebook.com/sharer.php?s=100';
	url += '&p[title]='     + encodeURIComponent(ptitle);
	url += '&p[summary]='   + encodeURIComponent(text);
	url += '&p[url]='       + encodeURIComponent(purl);
	url += '&p[images][0]=' + encodeURIComponent(pimg);
	ftShare.popup(url);
	return false;
}

ftShare.twitter = function(purl, ptitle) {
	url  = 'http://twitter.com/share?';
	url += 'text='      + encodeURIComponent(ptitle);
	url += '&url='      + encodeURIComponent(purl);
	url += '&counturl=' + encodeURIComponent(purl);
	ftShare.popup(url);
	return false;
}

ftShare.mailru = function(purl, ptitle, pimg, text) {
	url  = 'http://connect.mail.ru/share?';
	url += 'url='          + encodeURIComponent(purl);
	url += '&title='       + encodeURIComponent(ptitle);
	url += '&description=' + encodeURIComponent(text);
	url += '&imageurl='    + encodeURIComponent(pimg);
	ftShare.popup(url);
	return false;
}

ftShare.popup = function(url) {
	window.open(url,'','toolbar=0,status=0,width=626,height=436');
}