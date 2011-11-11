var BrowserDetect={init:function(){this.browser=this.searchString(this.dataBrowser)||"An unknown browser";this.version=this.searchVersion(navigator.userAgent)||this.searchVersion(navigator.appVersion)||"an unknown version";this.OS=this.searchString(this.dataOS)||"an unknown OS"},searchString:function(b){for(var a=0;a<b.length;a++){var c=b[a].string,d=b[a].prop;this.versionSearchString=b[a].versionSearch||b[a].identity;if(c){if(c.indexOf(b[a].subString)!=-1)return b[a].identity}else if(d)return b[a].identity}},
searchVersion:function(b){var a=b.indexOf(this.versionSearchString);if(a!=-1)return parseFloat(b.substring(a+this.versionSearchString.length+1))},dataBrowser:[{string:navigator.userAgent,subString:"Chrome",identity:"Chrome"},{string:navigator.userAgent,subString:"OmniWeb",versionSearch:"OmniWeb/",identity:"OmniWeb"},{string:navigator.vendor,subString:"Apple",identity:"Safari",versionSearch:"Version"},{prop:window.opera,identity:"Opera"},{string:navigator.vendor,subString:"iCab",identity:"iCab"},{string:navigator.vendor,
subString:"KDE",identity:"Konqueror"},{string:navigator.userAgent,subString:"Firefox",identity:"Firefox"},{string:navigator.vendor,subString:"Camino",identity:"Camino"},{string:navigator.userAgent,subString:"Netscape",identity:"Netscape"},{string:navigator.userAgent,subString:"MSIE",identity:"Explorer",versionSearch:"MSIE"},{string:navigator.userAgent,subString:"Gecko",identity:"Mozilla",versionSearch:"rv"},{string:navigator.userAgent,subString:"Mozilla",identity:"Netscape",versionSearch:"Mozilla"}],
dataOS:[{string:navigator.platform,subString:"Win",identity:"Windows"},{string:navigator.platform,subString:"Mac",identity:"Mac"},{string:navigator.userAgent,subString:"iPhone",identity:"iPhone/iPod"},{string:navigator.platform,subString:"Linux",identity:"Linux"}]};BrowserDetect.init();
var IconBase = document.getElementById('iconpath').getAttribute('content');
var BrowserDetails = {
    'Internet Explorer': {
        url:'http://microsoft.com/ie',
        icon:IconBase+'/ie.png'
    },
    'Safari': {
        url:'http://www.apple.com/safari/',
        icon:IconBase+'/safari.png'
    },
    'Firefox': {
        url:'http://getfirefox.com',
        icon:IconBase+'/firefox.png'
    },
    'Opera': {
        url:'http://www.opera.com/download/',
        icon:IconBase+'/opera.png'
    },
    'Chrome': {
        url:'http://www.google.com/chrome/',
        icon:IconBase+'/chrome.png'
    }
};
function ShowBH () {
    document.getElementById('bh-update').href=BrowserDetails[BrowserDetect.browser].url || '#';
    document.getElementById('bh-browsername').innerHTML = BrowserDetect.browser;
    document.getElementById('bh-icon').src=BrowserDetails[BrowserDetect.browser].icon || BrowserDetails['Internet Explorer'].icon;
    document.getElementById('browser-helper').style.display = 'block';
    document.getElementsByTagName('body')[0].style.backgroundPosition = '0 100px';
}
function CheckBrowser () {
    if(getCookie('browser-helped')=='true'){return;}
    //if(BrowserDetect.OS != "Windows" && BrowserDetect.OS != "Mac"){return;}
    switch(BrowserDetect.browser){
        case 'Explorer':
            BrowserDetect.browser = 'Internet Explorer';
            if(BrowserDetect.version < 9){ShowBH()}
            break;
        case 'Firefox':
            if(BrowserDetect.version < 4){ShowBH()}
            break;
        case 'Chrome':
            if(BrowserDetect.version < 10){ShowBH()}
            break;
        case 'Safari':
            if(BrowserDetect.version < 5){ShowBH()}
            break;
        case 'Opera':
            if(BrowserDetect.version < 10){ShowBH()}
            break;
        default:
            break;
    }
}
jQuery(function(){
    CheckBrowser();
    jQuery('#bh-hide').click(function(){document.getElementById('browser-helper').style.display = 'none';document.getElementsByTagName('body')[0].style.backgroundPosition = '';setCookie('browser-helped','true',14);return false;});
});