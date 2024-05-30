jQuery(function ($) {

$(document).ready(function () {
   
    var sbdstoredNoticeId = localStorage.getItem('qcld_wpbot_Notice_set');
    var qcld_chatbot_Notice_time_set = localStorage.getItem('qcld_wpbot_Notice_time_set');
    var notice_current_time = Math.round(new Date().getTime() / 1000);
    if ('promotion-wpchatbot' == sbdstoredNoticeId && qcld_chatbot_Notice_time_set > notice_current_time  ) {
        $('#promotion-wpchatbot').css({'display': 'none'});
    }
    $(document).on('click', '#promotion-wpchatbot .notice-dismiss', function(e){
        var currentDom = $(this);
        var currentWrap = currentDom.closest('.notice');
        currentWrap.css({'display': 'none'});
        localStorage.setItem('qcld_wpbot_Notice_set', 'promotion-wpchatbot');
        var ts = Math.round(new Date().getTime() / 1000);
        var tsYesterday = ts + (24 * 3600);
        localStorage.setItem('qcld_wpbot_Notice_time_set', tsYesterday);
    });
    

    [].slice.call(document.querySelectorAll('.wp-chatbot-tabs')).forEach(function (el) {

        new CBPFWTabs(el);

    });

    if(localStorage.getItem('tabData')){

        $(".content-wrap section").removeClass('content-current');

        $(".wp-chatbot-tabs nav ul li").each(function (index, elm) {

            if(localStorage.getItem('tabData')==$(this).attr('tab-data')){

                $(this).addClass('tab-current');

                $(".content-wrap section").eq(index).addClass('content-current');

            }else{

                $(this).removeClass('tab-current');

            }

        })

        /*$(".content-wrap section").each(function (el) {



        });*/

    }

    $(".wp-chatbot-tabs nav ul li a ").on('click',function () {

        // Remove others tab and contents

        $(".wp-chatbot-tabs nav ul li").removeClass('tab-current');

        $(".content-wrap section").removeClass('content-current');

        // add current tab and contents

        $(this).parent().addClass('tab-current');

        $(".content-wrap section").eq($(".wp-chatbot-tabs nav ul li a ").index(this)).addClass('content-current');

        //Change action url , set add localStorge and url change.

        $('#wp-chatbot-admin-form').attr('action',$(this).attr('href'));

        localStorage.setItem('tabData',$(this).parent().attr('tab-data'));

        window.history.pushState("changeUrl", "wpwBot", $(this).attr('href'));



    });
    $('.wp-chatbot-hours input').timepicker({ 'timeFormat': 'H:i' });
    //Drag and drop support builders
    $('#wp-chatbot-support-builder').sortable({
			cursor: 'move',
			revert: true,
			start: function (e, ui) {
			  $(ui.item).find('textarea').each(function () {
				 tinymce.execCommand('mceRemoveEditor', false, $(this).attr('id'));
			  });
			},
			stop: function (e, ui) {
			  $(ui.item).find('textarea').each(function () {
				 tinymce.execCommand('mceAddEditor', true, $(this).attr('id'));
			  });
			}
	});
    $("#wp-chatbot-support-builder" ).disableSelection();
	
	$('#wp_chatbot_floatingiconbg_color').wpColorPicker();
	console.log('hello world');

});

/*

Support building from admin panel.

*/

//Add Support query.
    var supportBlocks=$("#add-more-support-query").parent().parent().parent().find('textarea').length;
$("#add-more-support-query").on('click',function () {
      console.log('blocks :',supportBlocks);
      supportBlocks=parseInt(supportBlocks+1)
      var textarea_id='chatbot-query-builder'+supportBlocks;

        var firsBlock='<div class="row">'+

            '<div class="col-xs-12">'+
            '<button type="button"  class="btn btn-danger btn-sm wp-chatbot-remove-support pull-right"><i class="fa fa-times" aria-hidden="true"></i></button>'+
        
            '<div class="cxsc-settings-blocks">'+

            '<p class="qc-opt-dcs-font">Support query </p>'+

            '<input type="text" class="form-control" name="support_query[]"  placeholder="Support query">'+

            '<p class="qc-opt-dcs-font"><br><strong>Support answer</strong></p>'+

            '<textarea id="'+textarea_id+'" name="support_ans[]" class="form-control chatbot-query-builder" cols="30" rows="2"></textarea>'+

            '</div>'+

            '</div>'+

            '</div>';

        $(".block-inner").append(firsBlock);
        setTimeout(function (e) {
            //quicktags({id : ed_id,buttons:"strong,em,link,block,del,ins,img,ul,ol,li,code,more,close,dfw"});
            tinyMCE.execCommand('mceAddEditor', false, textarea_id);
        },500);

});

//Remove Support query.

$(document).on('click','.wp-chatbot-remove-support',function () {

	if(confirm('Are you sure to delete this support query block?')){

		$(this).parent().parent().remove();

	}

});


   //for downloading gc-client
    $('#qc_wpbot_gc_download').on('click', function(e){
        e.preventDefault();
        $.ajax(
            {
              type: 'POST', // 'POST' here so that _upload_ progress _also_ makes sense; 
                            // Change to 'GET' if you need. 
              url: ajax_object.ajax_url, data: {
                  'action': 'qcld_wp_chatbot_gc_client_download',
                  'nonce': ajax_object.ajax_nonce,
              },
              beforeSend: function()
              {
                $('.qcld_wpbot_download_statuses').append('<p>Downloading...</p>');

              },            
              success: function(data){
                $('.qcld_wpbot_download_statuses').append('<p>'+data.content+'</p>');
                if(data.status=='success'){

                    $.ajax(
                        {
                            type: 'POST', // 'POST' here so that _upload_ progress _also_ makes sense; 
                                        // Change to 'GET' if you need. 
                            url: ajax_object.ajax_url, data: {
                                'action': 'qcld_wp_chatbot_gc_client_extract',
                                'nonce': ajax_object.ajax_nonce
                            },
                            beforeSend: function()
                            {
                                $('.qcld_wpbot_download_statuses').append('<p>Extracting files...</p>');
            
                            },            
                            success: function(data){
                                $('.qcld_wpbot_download_statuses').append('<p>'+data.content+'</p>');
                                if(data.status=='success'){
                                    $('.qcld_wpbot_download_statuses').append('<p>Done.</p>');
                                }

                            }
                    });
                }                
                
              }
        });

    })


/*

 Notification building from admin panel.

 */

//Add Support query.
    var notification_blocks=$(this).parent().parent().parent().find('.notification-block-inner').length;
    $("#add-more-notification-message").on('click',function () {
        notification_blocks=parseInt(notification_blocks+1);
        var notification_text_area_id='notification_text_area_'+notification_blocks;
        tinyMCE.triggerSave();
        var lastChildVal=$(this).parent().parent().parent().find('.notification-block-inner').children('.row').last().find('textarea').val();

        var firsBlock='<div class="row">'+

            '<div class="col-xs-12">'+

            '<button type="button"  class="btn btn-danger btn-sm wp-chatbot-remove-notification pull-right"><i class="fa fa-times" aria-hidden="true"></i></button><br>'+

            '<div class="cxsc-settings-blocks">'+

            '<textarea id="'+notification_text_area_id+'" name="qlcd_wp_chatbot_notifications[]" placeholder="Notification Message" class="form-control qlcd_wp_chatbot_notifications" cols="30" rows="2"></textarea>'+

            '</div><br>'+

            '</div>'+

            '</div>';

        if(lastChildVal!=""){

            $(".notification-block-inner").append(firsBlock);
            setTimeout(function (e) {
                //quicktags({id : ed_id,buttons:"strong,em,link,block,del,ins,img,ul,ol,li,code,more,close,dfw"});
                tinyMCE.execCommand('mceAddEditor', false, notification_text_area_id);
            },500);

        } else{

            alert('Please fill up last notification message first');

        }
    });

//Remove Support query.

    $(document).on('click','.wp-chatbot-remove-notification',function () {

        if(confirm('Are you sure to delete this support query block?')){



            var langItems=$(this).parent().parent().parent().children('.row');

            if(langItems.length<=3){

                alert('At least one item is required.');

            }else{

                $(this).parent().parent().remove();

            }

        }

    });

/*

Multiple option for Language setting

*/



$(document).on('click','.wp-chatbot-lng-item-add',function () {

	//checking last input is not empty

	var lastChildVal=$(this).parent().parent().parent().find('.wp-chatbot-lng-items').children('.row').last().find('input').val();

	if(lastChildVal!=""){

	var child=$(this).parent().parent().parent().find('.wp-chatbot-lng-items').children('.row').last().clone();

	child.find('input').val("");

	} else{

		alert('Please fill up last item first');

	}

    $(this).parent().parent().parent().find('.wp-chatbot-lng-items').append(child);

});



$(document).on('click','.wp-chatbot-lng-item-remove',function () {

	 var langItems=$(this).parent().parent().parent().children('.row');

	 if(langItems.length<=1){

		 alert('At least one item is required.');

	 }else{

		 $(this).parent().parent().remove();

	 }



});

    /***

     * wpwBot Theme background

     *

     */

    $(document).on('change','#qcld_wb_chatbot_change_bg',function (e) {

         if($(this).is(':checked')){

             $('.qcld-wp-chatbot-board-bg-container').show();

         }else{

             $('.qcld-wp-chatbot-board-bg-container').hide();

         }

    });



    //Reset to defualt all options

    $('#qcld-wp-chatbot-reset-option').on('click',function () {

        var returnDefualt = confirm("Are you sure you want to reset all options to Default? Resetting Will Delete All Saved Settings, Custom Messages, Languages etc.");

        if (returnDefualt == true) {

            var data = {

                'action': 'qcld_wb_chatboot_delete_all_options',
                'wpnonce': ajax_object.ajax_nonce,
            };

            jQuery.post(ajax_object.ajax_url, data, function (response) {

                alert(response);

                window.location.reload();

            });

        }

    });

  var stopWordsList={

      english:"a,able,about,above,abst,accordance,according,accordingly,across,act,actually,added,adj,affected,affecting,affects,after,afterwards,again,against,ah,all,almost,alone,along,already,also,although,always,am,among,amongst,an,and,announce,another,any,anybody,anyhow,anymore,anyone,anything,anyway,anyways,anywhere,apparently,approximately,are,aren,arent,arise,around,as,aside,ask,asking,at,auth,available,away,awfully,b,back,be,became,because,become,becomes,becoming,been,before,beforehand,begin,beginning,beginnings,begins,behind,being,believe,below,beside,besides,between,beyond,biol,both,brief,briefly,but,by,c,ca,came,can,cannot,can't,cause,causes,certain,certainly,co,com,come,comes,contain,containing,contains,could,couldnt,d,date,did,didn't,different,do,does,doesn't,doing,done,don't,down,downwards,due,during,e,each,ed,edu,effect,eg,eight,eighty,either,else,elsewhere,end,ending,enough,especially,et,et-al,etc,even,ever,every,everybody,everyone,everything,everywhere,ex,except,f,far,few,ff,fifth,first,five,fix,followed,following,follows,for,former,formerly,forth,found,four,from,further,furthermore,g,gave,get,gets,getting,give,given,gives,giving,go,goes,gone,got,gotten,h,had,happens,hardly,has,hasn't,have,haven't,having,he,hed,hence,her,here,hereafter,hereby,herein,heres,hereupon,hers,herself,hes,hi,hid,him,himself,his,hither,home,how,howbeit,however,hundred,i,id,ie,if,i'll,im,immediate,immediately,importance,important,in,inc,indeed,index,information,instead,into,invention,inward,is,isn't,it,itd,it'll,its,itself,i've,j,just,k,keep,keeps,kept,kg,km,know,known,knows,l,largely,last,lately,later,latter,latterly,least,less,lest,let,lets,like,liked,likely,line,little,'ll,look,looking,looks,ltd,m,made,mainly,make,makes,many,may,maybe,me,mean,means,meantime,meanwhile,merely,mg,might,million,miss,ml,more,moreover,most,mostly,mr,mrs,much,mug,must,my,myself,n,na,name,namely,nay,nd,near,nearly,necessarily,necessary,need,needs,neither,never,nevertheless,new,next,nine,ninety,no,nobody,non,none,nonetheless,noone,nor,normally,nos,not,noted,nothing,now,nowhere,o,obtain,obtained,obviously,of,off,often,oh,ok,okay,old,omitted,on,once,one,ones,only,onto,or,ord,other,others,otherwise,ought,our,ours,ourselves,out,outside,over,overall,owing,own,p,page,pages,part,particular,particularly,past,per,perhaps,placed,please,plus,poorly,possible,possibly,potentially,pp,predominantly,present,previously,primarily,probably,promptly,proud,provides,put,q,que,quickly,quite,qv,r,ran,rather,rd,re,readily,really,recent,recently,ref,refs,regarding,regardless,regards,related,relatively,research,respectively,resulted,resulting,results,right,run,s,said,same,saw,say,saying,says,sec,section,see,seeing,seem,seemed,seeming,seems,seen,self,selves,sent,seven,several,shall,she,shed,she'll,shes,should,shouldn't,show,showed,shown,showns,shows,significant,significantly,similar,similarly,since,six,slightly,so,some,somebody,somehow,someone,somethan,something,sometime,sometimes,somewhat,somewhere,soon,sorry,specifically,specified,specify,specifying,still,stop,strongly,sub,substantially,successfully,such,sufficiently,suggest,sup,sure,t,take,taken,taking,tell,tends,th,than,thank,thanks,thanx,that,that'll,thats,that've,the,their,theirs,them,themselves,then,thence,there,thereafter,thereby,thered,therefore,therein,there'll,thereof,therere,theres,thereto,thereupon,there've,these,they,theyd,they'll,theyre,they've,think,this,those,thou,though,thoughh,thousand,throug,through,throughout,thru,thus,til,tip,to,together,too,took,toward,towards,tried,tries,truly,try,trying,ts,twice,two,u,un,under,unfortunately,unless,unlike,unlikely,until,unto,up,upon,ups,us,use,used,useful,usefully,usefulness,uses,using,usually,v,value,various,'ve,very,via,viz,vol,vols,vs,w,want,wants,was,wasnt,way,we,wed,welcome,we'll,went,were,werent,we've,what,whatever,what'll,whats,when,whence,whenever,where,whereafter,whereas,whereby,wherein,wheres,whereupon,wherever,whether,which,while,whim,whither,who,whod,whoever,whole,who'll,whom,whomever,whos,whose,why,widely,willing,wish,with,within,without,wont,words,world,would,wouldnt,www,x,y,yes,yet,you,youd,you'll,your,youre,yours,yourself,yourselves,you've,z,zero",

      arabic:"فى,في,كل,لم,لن,له,من,هو,هي,قوة,كما,لها,منذ,وقد,ولا,نفسه,لقاء,مقابل,هناك,وقال,وكان,نهاية,وقالت,وكانت,للامم,فيه,كلم,لكن,وفي,وقف,ولم,ومن,وهو,وهي,يوم,فيها,منها,مليار,لوكالة,يكون,يمكن,مليون,حيث,اكد,الا,اما,امس,السابق,التى,التي,اكثر,ايار,ايضا,ثلاثة,الذاتي,الاخيرة,الثاني,الثانية,الذى,الذي,الان,امام,ايام,خلال,حوالى,الذين,الاول,الاولى,بين,ذلك,دون,حول,حين,الف,الى,انه,اول,ضمن,انها,جميع,الماضي,الوقت,المقبل,اليوم,ـ,ف,و,و6,قد,لا,ما,مع,مساء,هذا,واحد,واضاف,واضافت,فان,قبل,قال,كان,لدى,نحو,هذه,وان,واكد,كانت,واوضح,مايو,ب,ا,أ,،,عشر,عدد,عدة,عشرة,عدم,عام,عاما,عن,عند,عندما,على,عليه,عليها,زيارة,سنة,سنوات,تم,ضد,بعد,بعض,اعادة,اعلنت,بسبب,حتى,اذا,احد,اثر,برس,باسم,غدا,شخصا,صباح,اطار,اربعة,اخرى,بان,اجل,غير,بشكل,حاليا,بن,به,ثم,اف,ان,او,اي,بها,صفر",

      bulgarian:"а,автентичен,аз,ако,ала,бе,без,беше,би,бивш,бивша,бившо,бил,била,били,било,благодаря,близо,бъдат,бъде,бяха,в,вас,ваш,ваша,вероятно,вече,взема,ви,вие,винаги,внимава,време,все,всеки,всички,всичко,всяка,във,въпреки,върху,г,ги,главен,главна,главно,глас,го,година,години,годишен,д,да,дали,два,двама,двамата,две,двете,ден,днес,дни,до,добра,добре,добро,добър,докато,докога,дори,досега,доста,друг,друга,други,е,евтин,едва,един,една,еднаква,еднакви,еднакъв,едно,екип,ето,живот,за,забавям,зад,заедно,заради,засега,заспал,затова,защо,защото,и,из,или,им,има,имат,иска,й,каза,как,каква,какво,както,какъв,като,кога,когато,което,които,кой,който,колко,която,къде,където,към,лесен,лесно,ли,лош,м,май,малко,ме,между,мек,мен,месец,ми,много,мнозина,мога,могат,може,мокър,моля,момента,му,н,на,над,назад,най,направи,напред,например,нас,не,него,нещо,нея,ни,ние,никой,нито,нищо,но,нов,нова,нови,новина,някои,някой,няколко,няма,обаче,около,освен,особено,от,отгоре,отново,още,пак,по,повече,повечето,под,поне,поради,после,почти,прави,пред,преди,през,при,пък,първата,първи,първо,пъти,равен,равна,с,са,сам,само,се,сега,си,син,скоро,след,следващ,сме,смях,според,сред,срещу,сте,съм,със,също,т,тази,така,такива,такъв,там,твой,те,тези,ти,т.н.,то,това,тогава,този,той,толкова,точно,три,трябва,тук,тъй,тя,тях,у,утре,харесва,хиляди,ч,часа,че,често,чрез,ще,щом,юмрук,я,як",

      catalan:"a,abans,algun,alguna,algunes,alguns,altre,amb,ambdós,anar,ans,aquell,aquelles,aquells,aquí,bastant,bé,cada,com,consegueixo,conseguim,conseguir,consigueix,consigueixen,consigueixes,dalt,de,des de,dins,el,elles,ells,els,en,ens,entre,era,erem,eren,eres,es,és,éssent,està,estan,estat,estava,estem,esteu,estic,ets,fa,faig,fan,fas,fem,fer,feu,fi,haver,i,inclòs,jo,la,les,llarg,llavors,mentre,meu,mode,molt,molts,nosaltres,o,on,per,per,per que,però,perquè,podem,poden,poder,podeu,potser,primer,puc,quan,quant,qui,sabem,saben,saber,sabeu,sap,saps,sense,ser,seu,seus,si,soc,solament,sols,som,sota,també,te,tene,tenim,tenir,teniu,teu,tinc,tot,últim,un,un,una,unes,uns,ús,va,vaig,van,vosaltres",

      czech:"ačkoli,ahoj,ale,anebo,ano,asi,aspoň,během,bez,beze,blízko,bohužel,brzo,bude,budeme,budeš,budete,budou,budu,byl,byla,byli,bylo,byly,bys,čau,chce,chceme,chceš,chcete,chci,chtějí,chtít,chut',chuti,co,čtrnáct,čtyři,dál,dále,daleko,děkovat,děkujeme,děkuji,den,deset,devatenáct,devět,do,dobrý,docela,dva,dvacet,dvanáct,dvě,hodně,já,jak,jde,je,jeden,jedenáct,jedna,jedno,jednou,jedou,jeho,její,jejich,jemu,jen,jenom,ještě,jestli,jestliže,jí,jich,jím,jimi,jinak,jsem,jsi,jsme,jsou,jste,kam,kde,kdo,kdy,když,ke,kolik,kromě,která,které,kteří,který,kvůli,má,mají,málo,mám,máme,máš,máte,mé,mě,mezi,mí,mít,mně,mnou,moc,mohl,mohou,moje,moji,možná,můj,musí,může,my,na,nad,nade,nám,námi,naproti,nás,náš,naše,naši,ne,ně,nebo,nebyl,nebyla,nebyli,nebyly,něco,nedělá,nedělají,nedělám,neděláme,neděláš,neděláte,nějak,nejsi,někde,někdo,nemají,nemáme,nemáte,neměl,němu,není,nestačí,nevadí,než,nic,nich,ním,nimi,nula,od,ode,on,ona,oni,ono,ony,osm,osmnáct,pak,patnáct,pět,po,pořád,potom,pozdě,před,přes,přese,pro,proč,prosím,prostě,proti,protože,rovně,se,sedm,sedmnáct,šest,šestnáct,skoro,smějí,smí,snad,spolu,sta,sté,sto,ta,tady,tak,takhle,taky,tam,tamhle,tamhleto,tamto,tě,tebe,tebou,ted',tedy,ten,ti,tisíc,tisíce,to,tobě,tohle,toto,třeba,tři,třináct,trošku,tvá,tvé,tvoje,tvůj,ty,určitě,už,vám,vámi,vás,váš,vaše,vaši,ve,večer,vedle,vlastně,všechno,všichni,vůbec,vy,vždy,za,zač,zatímco,ze,že",

      danish:"ad,af,alle,alt,anden,at,blev,blive,bliver,da,de,dem,den,denne,der,deres,det,dette,dig,din,disse,dog,du,efter,eller,en,end,er,et,for,fra,ham,han,hans,har,havde,have,hende,hendes,her,hos,hun,hvad,hvis,hvor,i,ikke,ind,jeg,jer,jo,kunne,man,mange,med,meget,men,mig,min,mine,mit,mod,ned,noget,nogle,nu,når,og,også,om,op,os,over,på,selv,sig,sin,sine,sit,skal,skulle,som,sådan,thi,til,ud,under,var,vi,vil,ville,vor,være,været",

      dutch:"aan,al,alles,als,altijd,andere,ben,bij,daar,dan,dat,de,der,deze,die,dit,doch,doen,door,dus,een,eens,en,er,ge,geen,geweest,haar,had,heb,hebben,heeft,hem,het,hier,hij,hoe,hun,iemand,iets,ik,in,is,ja,je,kan,kon,kunnen,maar,me,meer,men,met,mij,mijn,moet,na,naar,niet,niets,nog,nu,of,om,omdat,onder,ons,ook,op,over,reeds,te,tegen,toch,toen,tot,u,uit,uw,van,veel,voor,want,waren,was,wat,werd,wezen,wie,wil,worden,wordt,zal,ze,zelf,zich,zij,zijn,zo,zonder,zou",

      finnish:"ei,eivät,emme,en,et,ette,että,he,heidän,heidät,heihin,heille,heillä,heiltä,heissä,heistä,heitä,hän,häneen,hänelle,hänellä,häneltä,hänen,hänessä,hänestä,hänet,häntä,itse,ja,johon,joiden,joihin,joiksi,joilla,joille,joilta,joina,joissa,joista,joita,joka,joksi,jolla,jolle,jolta,jona,jonka,jos,jossa,josta,jota,jotka,kanssa,keiden,keihin,keiksi,keille,keillä,keiltä,keinä,keissä,keistä,keitä,keneen,keneksi,kenelle,kenellä,keneltä,kenen,kenenä,kenessä,kenestä,kenet,ketkä,ketkä,ketä,koska,kuin,kuka,kun,me,meidän,meidät,meihin,meille,meillä,meiltä,meissä,meistä,meitä,mihin,miksi,mikä,mille,millä,miltä,minkä,minkä,minua,minulla,minulle,minulta,minun,minussa,minusta,minut,minuun,minä,minä,missä,mistä,mitkä,mitä,mukaan,mutta,ne,niiden,niihin,niiksi,niille,niillä,niiltä,niin,niin,niinä,niissä,niistä,niitä,noiden,noihin,noiksi,noilla,noille,noilta,noin,noina,noissa,noista,noita,nuo,nyt,näiden,näihin,näiksi,näille,näillä,näiltä,näinä,näissä,näistä,näitä,nämä,ole,olemme,olen,olet,olette,oli,olimme,olin,olisi,olisimme,olisin,olisit,olisitte,olisivat,olit,olitte,olivat,olla,olleet,ollut,on,ovat,poikki,se,sekä,sen,siihen,siinä,siitä,siksi,sille,sillä,sillä,siltä,sinua,sinulla,sinulle,sinulta,sinun,sinussa,sinusta,sinut,sinuun,sinä,sinä,sitä,tai,te,teidän,teidät,teihin,teille,teillä,teiltä,teissä,teistä,teitä,tuo,tuohon,tuoksi,tuolla,tuolle,tuolta,tuon,tuona,tuossa,tuosta,tuota,tähän,täksi,tälle,tällä,tältä,tämä,tämän,tänä,tässä,tästä,tätä,vaan,vai,vaikka,yli",

      french:"a,ai,aie,aient,aies,ait,alors,as,au,aucun,aura,aurai,auraient,aurais,aurait,auras,aurez,auriez,aurions,aurons,auront,aussi,autre,aux,avaient,avais,avait,avant,avec,avez,aviez,avions,avoir,avons,ayant,ayez,ayons,bon,car,ce,ceci,cela,ces,cet,cette,ceux,chaque,ci,comme,comment,d,dans,de,dedans,dehors,depuis,des,deux,devoir,devrait,devrez,devriez,devrions,devrons,devront,dois,doit,donc,dos,droite,du,dès,début,dù,elle,elles,en,encore,es,est,et,eu,eue,eues,eurent,eus,eusse,eussent,eusses,eussiez,eussions,eut,eux,eûmes,eût,eûtes,faire,fais,faisez,fait,faites,fois,font,force,furent,fus,fusse,fussent,fusses,fussiez,fussions,fut,fûmes,fût,fûtes,haut,hors,ici,il,ils,j,je,juste,l,la,le,les,leur,leurs,lui,là,m,ma,maintenant,mais,me,mes,moi,moins,mon,mot,même,n,ne,ni,nom,nommé,nommée,nommés,nos,notre,nous,nouveau,nouveaux,on,ont,ou,où,par,parce,parole,pas,personne,personnes,peu,peut,plupart,pour,pourquoi,qu,quand,que,quel,quelle,quelles,quels,qui,sa,sans,se,sera,serai,seraient,serais,serait,seras,serez,seriez,serions,serons,seront,ses,seulement,si,sien,soi,soient,sois,soit,sommes,son,sont,sous,soyez,soyons,suis,sujet,sur,t,ta,tandis,te,tellement,tels,tes,toi,ton,tous,tout,trop,très,tu,un,une,valeur,voient,vois,voit,vont,vos,votre,vous,vu,y,à,ça,étaient,étais,était,étant,état,étiez,étions,été,étés,êtes,être",

      german:"aber,alle,allem,allen,aller,alles,als,also,am,an,ander,andere,anderem,anderen,anderer,anderes,anderm,andern,anders,auch,auf,aus,bei,bin,bis,bist,da,damit,dann,das,dass,dasselbe,dazu,daß,dein,deine,deinem,deinen,deiner,deines,dem,demselben,den,denn,denselben,der,derer,derselbe,derselben,des,desselben,dessen,dich,die,dies,diese,dieselbe,dieselben,diesem,diesen,dieser,dieses,dir,doch,dort,du,durch,ein,eine,einem,einen,einer,eines,einig,einige,einigem,einigen,einiger,einiges,einmal,er,es,etwas,euch,euer,eure,eurem,euren,eurer,eures,für,gegen,gewesen,hab,habe,haben,hat,hatte,hatten,hier,hin,hinter,ich,ihm,ihn,ihnen,ihr,ihre,ihrem,ihren,ihrer,ihres,im,in,indem,ins,ist,jede,jedem,jeden,jeder,jedes,jene,jenem,jenen,jener,jenes,jetzt,kann,kein,keine,keinem,keinen,keiner,keines,können,könnte,machen,man,manche,manchem,manchen,mancher,manches,mein,meine,meinem,meinen,meiner,meines,mich,mir,mit,muss,musste,nach,nicht,nichts,noch,nun,nur,ob,oder,ohne,sehr,sein,seine,seinem,seinen,seiner,seines,selbst,sich,sie,sind,so,solche,solchem,solchen,solcher,solches,soll,sollte,sondern,sonst,um,und,uns,unser,unsere,unserem,unseren,unserer,unseres,unter,viel,vom,von,vor,war,waren,warst,was,weg,weil,weiter,welche,welchem,welchen,welcher,welches,wenn,werde,werden,wie,wieder,will,wir,wird,wirst,wo,wollen,wollte,während,würde,würden,zu,zum,zur,zwar,zwischen,über",

      hindi:"अत,अपना,अपनी,अपने,अभी,अंदर,आदि,आप,इत्यादि,इन ,इनका,इन्हीं,इन्हें,इन्हों,इस,इसका,इसकी,इसके,इसमें,इसी,इसे,उन,उनका,उनकी,उनके,उनको,उन्हीं,उन्हें,उन्हों,उस,उसके,उसी,उसे,एक,एवं,एस,ऐसे,और,कई,कर,करता,करते,करना,करने,करें,कहते,कहा,का,काफ़ी,कि,कितना,किन्हें,किन्हों,किया,किर,किस,किसी,किसे,की,कुछ,कुल,के,को,कोई,कौन,कौनसा,गया,घर,जब,जहाँ,जा,जितना,जिन,जिन्हें,जिन्हों,जिस,जिसे,जीधर,जैसा,जैसे,जो,तक,तब,तरह,तिन,तिन्हें,तिन्हों,तिस,तिसे,तो,था,थी,थे,दबारा,दिया,दुसरा,दूसरे,दो,द्वारा,न,नके,नहीं,ना,निहायत,नीचे,ने,पर,पहले,पूरा,पे,फिर,बनी,बही,बहुत,बाद,बाला,बिलकुल,भी,भीतर,मगर,मानो,मे,में,यदि,यह,यहाँ,यही,या,यिह,ये,रखें,रहा,रहे,ऱ्वासा,लिए,लिये,लेकिन,व,वग़ैरह,वर्ग,वह,वहाँ,वहीं,वाले,वुह,वे,सकता,सकते,सबसे,सभी,साथ,साबुत,साभ,सारा,से,सो,संग,ही,हुआ,हुई,हुए,है,हैं,हो,होता,होती,होते,होना,होने",

      hungarian:"a,abban,ahhoz,ahogy,ahol,aki,akik,akkor,alatt,amely,amelyek,amelyekben,amelyeket,amelyet,amelynek,ami,amikor,amit,amolyan,amíg,annak,arra,arról,az,azok,azon,azonban,azt,aztán,azután,azzal,azért,be,belül,benne,bár,cikk,cikkek,cikkeket,csak,de,e,ebben,eddig,egy,egyes,egyetlen,egyik,egyre,egyéb,egész,ehhez,ekkor,el,ellen,elsõ,elég,elõ,elõször,elõtt,emilyen,ennek,erre,ez,ezek,ezen,ezt,ezzel,ezért,fel,felé,hanem,hiszen,hogy,hogyan,igen,ill,ill.,illetve,ilyen,ilyenkor,ismét,ison,itt,jobban,jó,jól,kell,kellett,keressünk,keresztül,ki,kívül,között,közül,legalább,legyen,lehet,lehetett,lenne,lenni,lesz,lett,maga,magát,majd,majd,meg,mellett,mely,melyek,mert,mi,mikor,milyen,minden,mindenki,mindent,mindig,mint,mintha,mit,mivel,miért,most,már,más,másik,még,míg,nagy,nagyobb,nagyon,ne,nekem,neki,nem,nincs,néha,néhány,nélkül,olyan,ott,pedig,persze,rá,s,saját,sem,semmi,sok,sokat,sokkal,szemben,szerint,szinte,számára,talán,tehát,teljes,tovább,továbbá,több,ugyanis,utolsó,után,utána,vagy,vagyis,vagyok,valaki,valami,valamint,való,van,vannak,vele,vissza,viszont,volna,volt,voltak,voltam,voltunk,által,általában,át,én,éppen,és,így,õ,õk,õket,össze,úgy,új,újabb,újra",

      indonesian:"ada,adanya,adalah,adapun,agak,agaknya,agar,akan,akankah,akhirnya,aku,akulah,amat,amatlah,anda,andalah,antar,diantaranya,antara,antaranya,diantara,apa,apaan,mengapa,apabila,apakah,apalagi,apatah,atau,ataukah,ataupun,bagai,bagaikan,sebagai,sebagainya,bagaimana,bagaimanapun,sebagaimana,bagaimanakah,bagi,bahkan,bahwa,bahwasanya,sebaliknya,banyak,sebanyak,beberapa,seberapa,begini,beginian,beginikah,beginilah,sebegini,begitu,begitukah,begitulah,begitupun,sebegitu,belum,belumlah,sebelum,sebelumnya,sebenarnya,berapa,berapakah,berapalah,berapapun,betulkah,sebetulnya,biasa,biasanya,bila,bilakah,bisa,bisakah,sebisanya,boleh,bolehkah,bolehlah,buat,bukan,bukankah,bukanlah,bukannya,cuma,percuma,dahulu,dalam,dan,dapat,dari,daripada,dekat,demi,demikian,demikianlah,sedemikian,dengan,depan,di,dia,dialah,dini,diri,dirinya,terdiri,dong,dulu,enggak,enggaknya,entah,entahlah,terhadap,terhadapnya,hal,hampir,hanya,hanyalah,harus,haruslah,harusnya,seharusnya,hendak,hendaklah,hendaknya,hingga,sehingga,ia,ialah,ibarat,ingin,inginkah,inginkan,ini,inikah,inilah,itu,itukah,itulah,jangan,jangankan,janganlah,jika,jikalau,juga,justru,kala,kalau,kalaulah,kalaupun,kalian,kami,kamilah,kamu,kamulah,kan,kapan,kapankah,kapanpun,dikarenakan,karena,karenanya,ke,kecil,kemudian,kenapa,kepada,kepadanya,ketika,seketika,khususnya,kini,kinilah,kiranya,sekiranya,kita,kitalah,kok,lagi,lagian,selagi,lah,lain,lainnya,melainkan,selaku,lalu,melalui,terlalu,lama,lamanya,selama,selama,selamanya,lebih,terlebih,bermacam,macam,semacam,maka,makanya,makin,malah,malahan,mampu,mampukah,mana,manakala,manalagi,masih,masihkah,semasih,masing,mau,maupun,semaunya,memang,mereka,merekalah,meski,meskipun,semula,mungkin,mungkinkah,nah,namun,nanti,nantinya,nyaris,oleh,olehnya,seorang,seseorang,pada,padanya,padahal,paling,sepanjang,pantas,sepantasnya,sepantasnyalah,para,pasti,pastilah,per,pernah,pula,pun,merupakan,rupanya,serupa,saat,saatnya,sesaat,saja,sajalah,saling,bersama,sama,sesama,sambil,sampai,sana,sangat,sangatlah,saya,sayalah,se,sebab,sebabnya,sebuah,tersebut,tersebutlah,sedang,sedangkan,sedikit,sedikitnya,segala,segalanya,segera,sesegera,sejak,sejenak,sekali,sekalian,sekalipun,sesekali,sekaligus,sekarang,sekarang,sekitar,sekitarnya,sela,selain,selalu,seluruh,seluruhnya,semakin,sementara,sempat,semua,semuanya,sendiri,sendirinya,seolah,seperti,sepertinya,sering,seringnya,serta,siapa,siapakah,siapapun,disini,disinilah,sini,sinilah,sesuatu,sesuatunya,suatu,sesudah,sesudahnya,sudah,sudahkah,sudahlah,supaya,tadi,tadinya,tak,tanpa,setelah,telah,tentang,tentu,tentulah,tentunya,tertentu,seterusnya,tapi,tetapi,setiap,tiap,setidaknya,tidak,tidakkah,tidaklah,toh,waduh,wah,wahai,sewaktu,walau,walaupun,wong,yaitu,yakni,yang",

      italian:"a,abbia,abbiamo,abbiano,abbiate,ad,adesso,agl,agli,ai,al,all,alla,alle,allo,allora,altre,altri,altro,anche,ancora,avemmo,avendo,avere,avesse,avessero,avessi,avessimo,aveste,avesti,avete,aveva,avevamo,avevano,avevate,avevi,avevo,avrai,avranno,avrebbe,avrebbero,avrei,avremmo,avremo,avreste,avresti,avrete,avrà,avrò,avuta,avute,avuti,avuto,c,che,chi,ci,coi,col,come,con,contro,cui,da,dagl,dagli,dai,dal,dall,dalla,dalle,dallo,degl,degli,dei,del,dell,della,delle,dello,dentro,di,dov,dove,e,ebbe,ebbero,ebbi,ecco,ed,era,erano,eravamo,eravate,eri,ero,essendo,faccia,facciamo,facciano,facciate,faccio,facemmo,facendo,facesse,facessero,facessi,facessimo,faceste,facesti,faceva,facevamo,facevano,facevate,facevi,facevo,fai,fanno,farai,faranno,fare,farebbe,farebbero,farei,faremmo,faremo,fareste,faresti,farete,farà,farò,fece,fecero,feci,fino,fosse,fossero,fossi,fossimo,foste,fosti,fra,fu,fui,fummo,furono,giù,gli,ha,hai,hanno,ho,i,il,in,io,l,la,le,lei,li,lo,loro,lui,ma,me,mi,mia,mie,miei,mio,ne,negl,negli,nei,nel,nell,nella,nelle,nello,no,noi,non,nostra,nostre,nostri,nostro,o,per,perché,però,più,pochi,poco,qua,quale,quanta,quante,quanti,quanto,quasi,quella,quelle,quelli,quello,questa,queste,questi,questo,qui,quindi,sarai,saranno,sarebbe,sarebbero,sarei,saremmo,saremo,sareste,saresti,sarete,sarà,sarò,se,sei,senza,si,sia,siamo,siano,siate,siete,sono,sopra,sotto,sta,stai,stando,stanno,starai,staranno,stare,starebbe,starebbero,starei,staremmo,staremo,stareste,staresti,starete,starà,starò,stava,stavamo,stavano,stavate,stavi,stavo,stemmo,stesse,stessero,stessi,stessimo,stesso,steste,stesti,stette,stettero,stetti,stia,stiamo,stiano,stiate,sto,su,sua,sue,sugl,sugli,sui,sul,sull,sulla,sulle,sullo,suo,suoi,te,ti,tra,tu,tua,tue,tuo,tuoi,tutti,tutto,un,una,uno,vai,vi,voi,vostra,vostre,vostri,vostro,è",

      norwegian:"alle,at,av,bare,begge,ble,blei,bli,blir,blitt,både,båe,da,de,deg,dei,deim,deira,deires,dem,den,denne,der,dere,deres,det,dette,di,din,disse,ditt,du,dykk,dykkar,då,eg,ein,eit,eitt,eller,elles,en,enn,er,et,ett,etter,for,fordi,fra,før,ha,hadde,han,hans,har,hennar,henne,hennes,her,hjå,ho,hoe,honom,hoss,hossen,hun,hva,hvem,hver,hvilke,hvilken,hvis,hvor,hvordan,hvorfor,i,ikke,ikkje,ingen,ingi,inkje,inn,inni,ja,jeg,kan,kom,korleis,korso,kun,kunne,kva,kvar,kvarhelst,kven,kvi,kvifor,man,mange,me,med,medan,meg,meget,mellom,men,mi,min,mine,mitt,mot,mykje,ned,no,noe,noen,noka,noko,nokon,nokor,nokre,nå,når,og,også,om,opp,oss,over,på,samme,seg,selv,si,sia,sidan,siden,sin,sine,sitt,sjøl,skal,skulle,slik,so,som,somme,somt,så,sånn,til,um,upp,ut,uten,var,vart,varte,ved,vere,verte,vi,vil,ville,vore,vors,vort,være,vært,vår,å",

      persian:"نداشته,شناسی,خواهیم,آباد,داشتن,نظیر,همچون,باره,نکرده,شان,سابق,هفت,دانند,جایی,بی,جز,زیرِ,رویِ,سریِ,تویِ,جلویِ,پیشِ,عقبِ,بالایِ,خارجِ,وسطِ,بیرونِ,سویِ,کنارِ,پاعینِ,نزدِ,نزدیکِ,دنبالِ,حدودِ,برابرِ,طبقِ,مانندِ,ضدِّ,هنگامِ,برایِ,مثلِ,باره,اثرِ,تولِ,علّتِ,سمتِ,عنوانِ,قصدِ,روب,جدا,کی,که,چیست,هست,کجا,کجاست,کَی,چطور,کدام,آیا,مگر,چندین,یک,چیزی,دیگر,کسی,بعری,هیچ,چیز,جا,کس,هرگز,یا,تنها,بلکه,خیاه,بله,بلی,آره,آری,مرسی,البتّه,لطفاً,ّه,انکه,وقتیکه,همین,پیش,مدّتی,هنگامی,مان,تان,براساس,شدند,ترین,امروز,باشند,ندارد,چون,قابل,گوید,دیگری,همان,خواهند,قبل,آمده,اکنون,تحت,طریق,گیری,جای,هنوز,چرا,البته,کنید,سازی,سوم,کنم,بلکه,زیر,توانند,ضمن,فقط,بودن,حق,آید,وقتی,اش,یابد,نخستین,مقابل,خدمات,امسال,تاکنون,مانند,تازه,آورد,فکر,آنچه,نخست,نشده,شاید,چهار,جریان,پنج,ساخته,زیرا,نزدیک,برداری,کسی,ریزی,رفت,گردد,مثل,آمد,ام,بهترین,دانست,کمتر,دادن,تمامی,جلوگیری,بیشتری,ایم,ناشی,چیزی,آنکه,بالا,بنابراین,ایشان,بعضی,دادند,داشتند,برخوردار,نخواهد,هنگام,نباید,غیر,نبود,دیده,وگو,داریم,چگونه,بندی,خواست,فوق,ده,نوعی,هستیم,دیگران,همچنان,سراسر,ندارند,گروهی,سعی,روزهای,آنجا,یکدیگر,کردم,بیست,بروز,سپس,رفته,آورده,نماید,باشیم,گویند,زیاد,خویش,همواره,گذاشته,شش,تر,کل,تمام,بدون,میلیارد,بودند,طی,بسیاری,گذاری,دهند,گرفت,طور,بار,آنان,گفته,شما,گیرد,مختلف,بعد,درباره,دوم,دیروز,نه,برخی,چنین,توسط,ولی,اینکه,حتی,نشان,کنیم,کردن,شدن,بیش,جدید,چند,هیچ,نام,اول,تواند,هایی,گرفته,روی,بسیار,بیشتر,شوند,سوی,میلیون,همین,دارند,بوده,داده,کردند,همچنین,چه,داشت,راه,داشته,داد,استفاده,نیست,هزار,دهد,من,بی,هستند,یکی,صورت,همه,اگر,پس,پیش,بین,نمی,مردم,دیگر,باشد,آنها,مورد,او,خواهد,هر,اند,دو,باید,اما,یا,کرده,ما,دارد,کنند,هم,وی,نیز,گفت,بود,بر,کند,تا,ای,شد,کرد,ها,خود,شده,شود,یک,آن,برای,های,با,را,است,این,می,که,از,به,در,و",
      polish:"ach,aj,albo,bardzo,bez,bo,być,ci,cię,ciebie,co,czy,daleko,dla,dlaczego,dlatego,do,dobrze,dokąd,dość,dużo,dwa,dwaj,dwie,dwoje,dziś,dzisiaj,gdyby,gdzie,go,ich,ile,im,inny,ja,ją,jak,jakby,jaki,je,jeden,jedna,jedno,jego,jej,jemu,jeśli,jest,jestem,jeżeli,już,każdy,kiedy,kierunku,kto,ku,lub,ma,mają,mam,mi,mną,mnie,moi,mój,moja,moje,może,mu,my,na,nam,nami,nas,nasi,nasz,nasza,nasze,natychmiast,nią,nic,nich,nie,niego,niej,niemu,nigdy,nim,nimi,niż,obok,od,około,on,ona,one,oni,ono,owszem,po,pod,ponieważ,przed,przedtem,są,sam,sama,się,skąd,tak,taki,tam,ten,to,tobą,tobie,tu,tutaj,twoi,twój,twoja,twoje,ty,wam,wami,was,wasi,wasz,wasza,wasze,we,więc,wszystko,wtedy,wy,żaden,zawsze,że",

      portuguese:"a,ao,aos,aquela,aquelas,aquele,aqueles,aquilo,as,até,com,como,da,das,de,dela,delas,dele,deles,depois,do,dos,e,ela,elas,ele,eles,em,entre,era,eram,essa,essas,esse,esses,esta,estamos,estas,estava,estavam,este,esteja,estejam,estejamos,estes,esteve,estive,estivemos,estiver,estivera,estiveram,estiverem,estivermos,estivesse,estivessem,estivéramos,estivéssemos,estou,está,estávamos,estão,eu,foi,fomos,for,fora,foram,forem,formos,fosse,fossem,fui,fôramos,fôssemos,haja,hajam,hajamos,havemos,hei,houve,houvemos,houver,houvera,houveram,houverei,houverem,houveremos,houveria,houveriam,houvermos,houverá,houverão,houveríamos,houvesse,houvessem,houvéramos,houvéssemos,há,hão,isso,isto,já,lhe,lhes,mais,mas,me,mesmo,meu,meus,minha,minhas,muito,na,nas,nem,no,nos,nossa,nossas,nosso,nossos,num,numa,não,nós,o,os,ou,para,pela,pelas,pelo,pelos,por,qual,quando,que,quem,se,seja,sejam,sejamos,sem,serei,seremos,seria,seriam,será,serão,seríamos,seu,seus,somos,sou,sua,suas,são,só,também,te,tem,temos,tenha,tenham,tenhamos,tenho,terei,teremos,teria,teriam,terá,terão,teríamos,teu,teus,teve,tinha,tinham,tive,tivemos,tiver,tivera,tiveram,tiverem,tivermos,tivesse,tivessem,tivéramos,tivéssemos,tu,tua,tuas,tém,tínhamos,um,uma,você,vocês,vos,à,às,éramos",

      romanian:"vreo,acelea,cita,degraba,lor,alta,tot,ai,dat,x,despre,peste,bine,dar,foarte,z,avea,multi,cit,alt,mai,sa,fie,tu,multe,e,orice,dintr,se,g,intr,niste,multa,insa,il,fost,a,abia,nimic,sub,acel,in,altceva,si,avem,altfel,c,ea,acest,li,parca,fi,dintre,unele,m,acestei,mare,cel,este,pe,atitia,uneori,acela,iti,astazi,acestui,o,imi,ele,ceilalti,pai,fata,noua,sa-ti,altul,au,i,prin,conform,aceste,anume,azi,k,unul,ala,unei,fara,ei,la,aceeasi,u,inapoi,acestea,acesta,catre,sale,asupra,as,aceea,ba,ale,da,le,apoi,aia,suntem,cum,isi,inainte,s,de,cind,cumva,chiar,acestia,daca,sunt,care,al,numai,cui,sus,tocmai,prea,cu,mi,eu,doar,niciodata,exact,putini,aiurea,tuturor,celor,astfel,atunci,citeva,cat,sau,fel,intre,acolo,nostri,ma,mult,una,ceea,iar,sintem,ati,din,geaba,sai,caruia,adica,inca,are,aici,ca,ia,nici,d,oricum,asta,carora,face,citiva,voi,unor,f,atat,toata,alaturi,cea,nu,totusi,ce,altii,acum,sint,capat,mod,deasupra,cam,vom,b,toate,careia,aceasta,atit,nimeni,ii,ci,unde,ul,plus,era,sa-mi,l,spre,dupa,nou,cele,acea,un,incit,n,cei,or,va,deci,acelasi,atatea,h,vor,decit,noi,cineva,desi,ceva,j,ului,atitea,avut,ar,pina,t,atata,unui,el,citi,asa,totul,pentru,atita,v,alti,asemenea,atatia,te,ne,deja,unii,p,atare,cite,cine,cand,toti,vreun,ori,r,alte,lui,ti,ni,aceia,am",

      russian:"а,в,г,е,ж,и,к,м,о,с,т,у,я,бы,во,вы,да,до,ее,ей,ею,её,же,за,из,им,их,ли,мы,на,не,ни,но,ну,нх,об,он,от,по,со,та,те,то,ту,ты,уж,без,был,вам,вас,ваш,вон,вот,все,всю,вся,всё,где,год,два,две,дел,для,его,ему,еще,ещё,или,ими,имя,как,кем,ком,кто,лет,мне,мог,мож,мои,мой,мор,моя,моё,над,нам,нас,наш,нее,ней,нем,нет,нею,неё,них,оба,она,они,оно,под,пор,при,про,раз,сам,сих,так,там,тем,тех,том,тот,тою,три,тут,уже,чем,что,эта,эти,это,эту,алло,буду,будь,бывь,была,были,было,быть,вами,ваша,ваше,ваши,ведь,весь,вниз,всем,всех,всею,года,году,даже,двух,день,если,есть,зато,кого,кому,куда,лишь,люди,мало,меля,меня,мимо,мира,мной,мною,мочь,надо,нами,наша,наше,наши,него,нему,ниже,ними,один,пока,пора,пять,рано,сама,сами,само,саму,свое,свои,свою,себе,себя,семь,стал,суть,твой,твоя,твоё,тебе,тебя,теми,того,тоже,тому,туда,хоть,хотя,чаще,чего,чему,чтоб,чуть,этим,этих,этой,этом,этот,более,будем,будет,будто,будут,вверх,вдали,вдруг,везде,внизу,время,всего,всеми,всему,всюду,давно,даром,долго,друго,жизнь,занят,затем,зачем,здесь,иметь,какая,какой,когда,кроме,лучше,между,менее,много,могут,может,можно,можхо,назад,низко,нужно,одной,около,опять,очень,перед,позже,после,потом,почти,пятый,разве,рядом,самим,самих,самой,самом,своей,своих,сеаой,снова,собой,собою,такая,также,такие,такое,такой,тобой,тобою,тогда,тысяч,уметь,часто,через,чтобы,шесть,этими,этого,этому,близко,больше,будете,будешь,бывает,важная,важное,важные,важный,вокруг,восемь,всегда,второй,далеко,дальше,девять,десять,должно,другая,другие,других,другое,другой,занята,занято,заняты,значит,именно,иногда,каждая,каждое,каждые,каждый,кругом,меньше,начала,нельзя,нибудь,никуда,ничего,обычно,однако,одного,отсюда,первый,потому,почему,просто,против,раньше,самими,самого,самому,своего,сейчас,сказал,совсем,теперь,только,третий,хорошо,хотеть,хочешь,четыре,шестой,восьмой,впрочем,времени,говорил,говорит,девятый,десятый,кажется,конечно,которая,которой,которые,который,которых,наверху,наконец,недавно,немного,нередко,никогда,однажды,посреди,сегодня,седьмой,сказала,сказать,сколько,слишком,сначала,спасибо,человек,двадцать,довольно,которого,наиболее,недалеко,особенно,отовсюду,двадцатый,миллионов,несколько,прекрасно,процентов,четвертый,двенадцать,непрерывно,пожалуйста,пятнадцать,семнадцать,тринадцать,двенадцатый,одиннадцать,пятнадцатый,семнадцатый,тринадцатый,шестнадцать,восемнадцать,девятнадцать,одиннадцатый,четырнадцать,шестнадцатый,восемнадцатый,девятнадцатый,действительно,четырнадцатый,многочисленная,многочисленное,многочисленные,многочисленный",

      slovak:"a,aby,aj,ak,ako,ale,alebo,and,ani,áno,asi,až,bez,bude,budem,budeš,budeme,budete,budú,by,bol,bola,boli,bolo,byť,cez,čo,či,ďalší,ďalšia,ďalšie,dnes,do,ho,ešte,for,i,ja,je,jeho,jej,ich,iba,iné,iný,som,si,sme,sú,k,kam,každý,každá,každé,každí,kde,keď,kto,ktorá,ktoré,ktorou,ktorý,ktorí,ku,lebo,len,ma,mať,má,máte,medzi,mi,mna,mne,mnou,musieť,môcť,môj,môže,my,na,nad,nám,náš,naši,nie,nech,než,nič,niektorý,nové,nový,nová,nové,noví,o,od,odo,of,on,ona,ono,oni,ony,po,pod,podľa,pokiaľ,potom,práve,pre,prečo,preto,pretože,prvý,prvá,prvé,prví,pred,predo,pri,pýta,s,sa,so,si,svoje,svoj,svojich,svojím,svojími,ta,tak,takže,táto,teda,te,tě,ten,tento,the,tieto,tým,týmto,tiež,to,toto,toho,tohoto,tom,tomto,tomuto,toto,tu,tú,túto,tvoj,ty,tvojími,už,v,vám,váš,vaše,vo,viac,však,všetok,vy,z,za,zo,že",

      spanish:"a,al,algo,algunas,algunos,ante,antes,como,con,contra,cual,cuando,de,del,desde,donde,durante,e,el,ella,ellas,ellos,en,entre,era,erais,eran,eras,eres,es,esa,esas,ese,eso,esos,esta,estaba,estabais,estaban,estabas,estad,estada,estadas,estado,estados,estamos,estando,estar,estaremos,estará,estarán,estarás,estaré,estaréis,estaría,estaríais,estaríamos,estarían,estarías,estas,este,estemos,esto,estos,estoy,estuve,estuviera,estuvierais,estuvieran,estuvieras,estuvieron,estuviese,estuvieseis,estuviesen,estuvieses,estuvimos,estuviste,estuvisteis,estuviéramos,estuviésemos,estuvo,está,estábamos,estáis,están,estás,esté,estéis,estén,estés,fue,fuera,fuerais,fueran,fueras,fueron,fuese,fueseis,fuesen,fueses,fui,fuimos,fuiste,fuisteis,fuéramos,fuésemos,ha,habida,habidas,habido,habidos,habiendo,habremos,habrá,habrán,habrás,habré,habréis,habría,habríais,habríamos,habrían,habrías,habéis,había,habíais,habíamos,habían,habías,han,has,hasta,hay,haya,hayamos,hayan,hayas,hayáis,he,hemos,hube,hubiera,hubierais,hubieran,hubieras,hubieron,hubiese,hubieseis,hubiesen,hubieses,hubimos,hubiste,hubisteis,hubiéramos,hubiésemos,hubo,la,las,le,les,lo,los,me,mi,mis,mucho,muchos,muy,más,mí,mía,mías,mío,míos,nada,ni,no,nos,nosotras,nosotros,nuestra,nuestras,nuestro,nuestros,o,os,otra,otras,otro,otros,para,pero,poco,por,porque,que,quien,quienes,qué,se,sea,seamos,sean,seas,seremos,será,serán,serás,seré,seréis,sería,seríais,seríamos,serían,serías,seáis,sido,siendo,sin,sobre,sois,somos,son,soy,su,sus,suya,suyas,suyo,suyos,sí,también,tanto,te,tendremos,tendrá,tendrán,tendrás,tendré,tendréis,tendría,tendríais,tendríamos,tendrían,tendrías,tened,tenemos,tenga,tengamos,tengan,tengas,tengo,tengáis,tenida,tenidas,tenido,tenidos,teniendo,tenéis,tenía,teníais,teníamos,tenían,tenías,ti,tiene,tienen,tienes,todo,todos,tu,tus,tuve,tuviera,tuvierais,tuvieran,tuvieras,tuvieron,tuviese,tuvieseis,tuviesen,tuvieses,tuvimos,tuviste,tuvisteis,tuviéramos,tuviésemos,tuvo,tuya,tuyas,tuyo,tuyos,tú,un,una,uno,unos,vosotras,vosotros,vuestra,vuestras,vuestro,vuestros,y,ya,yo,él,éramos",

      swedish:"alla,allt,att,av,blev,bli,blir,blivit,de,dem,den,denna,deras,dess,dessa,det,detta,dig,din,dina,ditt,du,där,då,efter,ej,eller,en,er,era,ert,ett,från,för,ha,hade,han,hans,har,henne,hennes,hon,honom,hur,här,i,icke,ingen,inom,inte,jag,ju,kan,kunde,man,med,mellan,men,mig,min,mina,mitt,mot,mycket,ni,nu,när,någon,något,några,och,om,oss,på,samma,sedan,sig,sin,sina,sitta,själv,skulle,som,så,sådan,sådana,sådant,till,under,upp,ut,utan,vad,var,vara,varför,varit,varje,vars,vart,vem,vi,vid,vilka,vilkas,vilken,vilket,vår,våra,vårt,än,är,åt,över",

      turkish:"mu,onlar,seksen,ama,trilyon,buna,bizim,þeyden,yirmi,altý,iki,seni,doksan,dört,bunun,ki,nereye,altmýþ,hem,milyon,kez,otuz,beþ,elli,bizi,da,sekiz,ve,çok,bu,veya,ya,kýrk,onlarýn,ona,bana,yetmiþ,milyar,þunu,senden,birþeyi,dokuz,yani,kimi,þeyler,kim,neden,senin,yedi,niye,üç,þey,mý,tüm,onlari,bunda,ise,þundan,hep,þuna,bin,ben,ondan,kimden,bazý,belki,ne,bundan,gibi,de,onlardan,sizi,sizin,daha,niçin,þunda,INSERmi,bunu,beni,ile,þu,þeyi,sizden,defa,biz,için,dahi,siz,nerde,kime,birþey,birkez,her,biri,on,mü,diye,acaba,sen,en,hepsi,bir,bizden,sanki,benim,nerede,onu,benden,yüz,birkaç,çünkü,nasýl,hiç,katrilyon",

      ukrainian:"a,б,в,г,е,ж,з,м,т,у,я,є,і,аж,ви,де,до,за,зі,ми,на,не,ну,нх,ні,по,та,ти,то,ту,ті,це,цю,ця,ці,чи,ще,що,як,їй,їм,їх,її,або,але,ало,без,був,вам,вас,ваш,вже,все,всю,вся,від,він,два,дві,для,ким,мож,моя,моє,мої,міг,між,мій,над,нам,нас,наш,нею,неї,них,ніж,ній,ось,при,про,під,пір,раз,рік,сам,сих,сім,так,там,теж,тим,тих,той,тою,три,тут,хоч,хто,цей,цим,цих,час,щоб,яка,які,адже,буде,буду,будь,була,були,було,бути,вами,ваша,ваше,ваші,весь,вниз,вона,вони,воно,всею,всім,всіх,втім,геть,далі,двох,день,дуже,зате,його,йому,каже,кого,коли,кому,крім,куди,лише,люди,мало,мати,мене,мені,миру,мною,може,нами,наша,наше,наші,ними,ніби,один,поки,пора,рано,року,році,сама,саме,саму,самі,свою,своє,свої,себе,собі,став,суть,така,таке,такі,твоя,твоє,твій,тебе,тими,тобі,того,тоді,тому,туди,хоча,хіба,цими,цієї,часу,чого,чому,який,яких,якої,якщо,ім'я,інша,інше,інші,буває,будеш,більш,вгору,вміти,внизу,вісім,давно,даром,добре,довго,друго,дякую,життя,зараз,знову,какая,кожен,кожна,кожне,кожні,краще,ледве,майже,менше,могти,можна,назад,немає,нижче,нього,однак,п'ять,перед,поруч,потім,проти,після,років,самим,самих,самій,свого,своєї,своїх,собою,справ,такий,також,тепер,тисяч,тобою,треба,трохи,усюди,усіма,хочеш,цього,цьому,часто,через,шість,якого,іноді,інший,інших,багато,будемо,будете,будуть,більше,всього,всьому,далеко,десять,досить,другий,дійсно,завжди,звідси,зовсім,кругом,кілька,людина,можуть,навіть,навіщо,нагорі,небудь,низько,ніколи,нікуди,нічого,обидва,одного,однієї,п'ятий,перший,просто,раніше,раптом,самими,самого,самому,сказав,скрізь,сьомий,третій,тільки,хотіти,чотири,чудово,шостий,близько,важлива,важливе,важливі,вдалині,восьмий,говорив,дев'ять,десятий,зайнята,зайнято,зайняті,занадто,значить,навколо,нарешті,нерідко,повинно,посеред,початку,пізніше,сказала,сказати,скільки,спасибі,частіше,важливий,двадцять,дев'ятий,зазвичай,зайнятий,звичайно,здається,найбільш,не можна,недалеко,особливо,потрібно,спочатку,сьогодні,численна,численне,численні,відсотків,двадцятий,звідусіль,мільйонів,нещодавно,прекрасно,четвертий,численний,будь ласка,дванадцять,одинадцять,сімнадцять,тринадцять,безперервно,дванадцятий,одинадцятий,одного разу,п'ятнадцять,сімнадцятий,тринадцятий,шістнадцять,вісімнадцять,п'ятнадцятий,чотирнадцять,шістнадцятий,вісімнадцятий,дев'ятнадцять,чотирнадцятий,дев'ятнадцятий",

  };

    //change the to defualt Stop word language options

    $('#qlcd_wp_chatbot_stop_words_name').on('change',function () {

        var lang=$(this).val();

        var stopWords=stopWordsList[lang];

        $("#qlcd_wp_chatbot_stop_words").val(stopWords);



    });

    //Custom Icon

    $('.wp_chatbot_custom_icon_button').click(function(e) {

        e.preventDefault();

        var image = wp.media({

            title: 'Custom Icon',

            // mutiple: true if you want to upload multiple files at once

            multiple: false

        })

        .open()

        .on('select', function(e){

            // This will return the selected image from the Media Uploader, the result is an object

            var uploaded_image = image.state().get('selection').first();

            var image_url = uploaded_image.toJSON().url;

            // Let's assign the url value to the hidden field value and img src.

            $('#wp_chatbot_custom_icon_src').attr('src',image_url);

            $('#wp_chatbot_custom_icon_path').val(image_url);

        });

    });

	
	$('#qc_wpbot_df_status').on('click', function(e){
        e.preventDefault();
        console.log('dftest')
        $.ajax(
            {
              type: 'POST', // 'POST' here so that _upload_ progress _also_ makes sense; 
                            // Change to 'GET' if you need. 
              url: ajax_object.ajax_url, data: {
                'action': 'qcld_wp_df_api_call',
                'dfquery': 'hi',
                'nonce': ajax_object.ajax_nonce,
                'sessionid': 'wpwBot_df_201sdf8071'
              },
              beforeSend: function()
              {
                $('.qcwp_df_status').append('<p>Connecting...</p>');

              },            
              success: function(data){
                var response = $.parseJSON(data);
                if(typeof response.responseId !== "undefined"){
                    $('.qcwp_df_status').html('<p>Dialogflow is connected successfully!</p>');                    
                }else{
                    $('.qcwp_df_status').html('<p>Connecton Failed. '+response.error.message+'</p><p class="df-connect-error">If DialogFlow connection is not working, please check <a href="'+document.location.pathname+'?page=wpbot_help_page#general_debugging">Debugging Steps</a> or <a href="https://www.wpbot.pro/free-support/" target="_blank">contact us</a> for support.</p>');
                }
                
              }
        });

    })
	
    //Custom Agent Icon

    $('.wp_chatbot_custom_agent_button').click(function(e) {

        e.preventDefault();

        var image = wp.media({

            title: 'Custom Agent',

            // mutiple: true if you want to upload multiple files at once

            multiple: false

        })

            .open()

            .on('select', function(e){

                // This will return the selected image from the Media Uploader, the result is an object

                var uploaded_image = image.state().get('selection').first();

                var image_url = uploaded_image.toJSON().url;

                // Let's assign the url value to the hidden field value and img src.

                $('#wp_chatbot_custom_agent_src').attr('src',image_url);

                $('#wp_chatbot_custom_agent_path').val(image_url);

            });

    });

    //Custom Backgroud image

        $('.qcld_wb_chatbot_board_bg_button').click(function(e) {

            e.preventDefault();

            var image = wp.media({

                title: 'Custom Agent',

                // mutiple: true if you want to upload multiple files at once

                multiple: false

            })

                .open()

                .on('select', function(e){

                    // This will return the selected image from the Media Uploader, the result is an object

                    var uploaded_image = image.state().get('selection').first();

                    var image_url = uploaded_image.toJSON().url;

                    // Let's assign the url value to the hidden field value and img src.

                    $('#qcld_wb_chatbot_board_bg_image').attr('src',image_url);

                    $('#qcld_wb_chatbot_board_bg_path').val(image_url);

                });

        });

     //wpwBot Load Control handler.

	jQuery("input[name='wp_chatbot_df_api']").on('change', function(e){
        e.preventDefault();
        if($(this).val()=='v1'){
            $('#wp-chatbot-df-section-v1').show('slow');
            $('#wp-chatbot-df-section-v2').hide('slow');
        }else{
            $('#wp-chatbot-df-section-v1').hide('slow');
            $('#wp-chatbot-df-section-v2').show('slow');
        }
     })

    if($("input[type=radio][name='wp_chatbot_df_api']:checked").val()=='v1'){
        $('#wp-chatbot-df-section-v1').show('slow');
    }else{
        $('#wp-chatbot-df-section-v1').hide();
    }

    if($("input[type=radio][name='wp_chatbot_df_api']:checked").val()=='v2'){
        $('#wp-chatbot-df-section-v2').show('slow');
    }else{
        $('#wp-chatbot-df-section-v2').hide();
    }
	 
	 
    if($("input[type=radio][name='wp_chatbot_show_pages']:checked").val()=='off'){

        $('#wp-chatbot-show-pages-list').show('slow');

    }else{

        $('#wp-chatbot-show-pages-list').hide('slow');

    }

    //on change.

    $('.wp-chatbot-show-pages').on('change',function (e) {

        if( $(this).val()=='off'){

            $('#wp-chatbot-show-pages-list').show('slow');

        }else{

            $('#wp-chatbot-show-pages-list').hide('slow');

        }

    })

    //Search options

    if($('#wp-chatbot-search-option').val()=='standard'){

        $('#wp-chatbot-standard-search').show();

        $('#wp-chatbot-advanced-search').hide();



    } else if($('#wp-chatbot-search-option').val()=='advanced'){

        $('#wp-chatbot-advanced-search').show();

        $('#wp-chatbot-standard-search').hide();

    }

    $('#wp-chatbot-search-option').on('change',function (e) {

        if($(this).val()=='standard'){

            $('#wp-chatbot-standard-search').show();

            $('#wp-chatbot-advanced-search').hide();

        } else if($(this).val()=='advanced'){

            $('#wp-chatbot-advanced-search').show();

            $('#wp-chatbot-standard-search').hide();

        }

    });



    //Product Index for categories & Tag search



    var wpChatbotIndexBtn=$('#qlcd_wp_chatbot_index');

    var wpChatbotIndexProcess = $('#qlcd_wp_chatbot_index_process');

    var wpChatbotIndexProgress = $('#qlcd_wp_chatbot_index_progress');

    var wpChatbotIndexLoader = $('#qlcd_wp_chatbot_index_loader');

    var wpChatbotSyncStatus;

    var wpChatbotIndexProcessed;

    var wpChatbotIndexToProcess;

    // Reindex table

    wpChatbotIndexBtn.on( 'click', function(e) {

       e.preventDefault();

        wpChatbotIndexProcess.html('');

        wpChatbotIndexProgress.text('');



       wpChatbotSyncStatus = 'sync';

        wpChatbotIndexToProcess  = 0;

        wpChatbotIndexProcessed = 0;



        wpChatbotIndexLoader.html('<img class="wp-chatbot-comment-loader" src="'+ajax_object.image_path+'comment.gif" alt="..." />');

        wpChatbotIndexProcess.html( wpChatbotIndexProcessed + '%' );



        qcld_wb_chatbot_sync();



    });





    function qcld_wb_chatbot_sync() {



        $.ajax({

            type: 'POST',

            url: ajax_object.ajax_url,

            data: {

                action: 'qcld-wp-chabot-reindex',
                'nonce': ajax_object.ajax_nonce

            },

            dataType: "json",

            success: function (response) {

               // console.log('begining    : ',response);

                if ( 'sync' !== wpChatbotSyncStatus ) {

                    return;

                }



                wpChatbotIndexToProcess = response.data.found_posts;

                wpChatbotIndexProcessed = response.data.offset;



                wpChatbotIndexProcessed = Math.floor( wpChatbotIndexProcessed / wpChatbotIndexToProcess * 100 );



                if ( 0 === response.data.offset && ! response.data.start ) {



                    // Sync finished

                    wpChatbotSyncStatus = 'finished';



                    //console.log('first : '+ response.data );

                    //console.log( "Reindex finished!" );



                   // $reindexBlock.removeClass('loading');

                   setTimeout(function () {

                       wpChatbotIndexProgress.text('Complete and '+response.data.found_posts+' Products found!' );

                       wpChatbotIndexLoader.html('');

                   },1000);





                } else {



                   // console.log('2nd  : '+ response.data );



                    wpChatbotIndexProcess.html ( wpChatbotIndexProcessed + '%  ' );





                    // We are starting a sync

                    wpChatbotSyncStatus = 'sync';



                    qcld_wb_chatbot_sync();

                }



            },

            error : function( jqXHR, textStatus ) {
                //console.log( "Request failed: " + textStatus );
                qcld_wb_chatbot_cancelSync();
            },
            complete: function () {

            }

        });
    }



    function qcld_wb_chatbot_cancelSync() {
        $.ajax( {
            method: 'post',
            url: ajax_object.ajax_url,
            data: {
                action: 'qcld-wp-chabot-cancel-index',
                'nonce': ajax_object.ajax_nonce
            }
        });
    }

    //Messenger Color scheme.

    $('#qlcd_wp_chatbot_fb_color').wpColorPicker();
    $('#wp_chatbot_proactive_bg_color').wpColorPicker();
    

    // Sub category for parent category
    $(document).on('change','#wp_chatbot_show_parent_category',function (e) {
        if($(this).is(':checked')){
            $('#wp_chatbot_sub_cats_container').show();
        }else{
            $('#wp_chatbot_sub_cats_container').hide();
        }
    })
    //Opening hours
    if($('#enable_wp_chatbot_opening_hour').is(':checked')){
        $('#wp-chatbot-hours-wrapper').show();
    }else{
        $('#wp-chatbot-hours-wrapper').hide();
    }
    $(document).on('change','#enable_wp_chatbot_opening_hour',function (e) {
        if($(this).is(':checked')){
            $('#wp-chatbot-hours-wrapper').show();
        }else{
            $('#wp-chatbot-hours-wrapper').hide();
        }
    })

    $(".wp-chatbot-hours-add-btn").on('click',function () {
        var elNumber=$(this).parent().parent().find('.wp-chatbot-hours-container').length;
        var dayName=$(this).attr('data-day');
        var hourSet='<div class="wp-chatbot-hours-container">'+
            '<div class="wp-chatbot-hours">'+
            '<input type="text" name="wpwbot_hours['+dayName+']['+elNumber+'][]" value="00:00" > <input type="text" name="wpwbot['+dayName+']['+elNumber+'][]" value="00:00">'+
            '</div>'+
            '<div class="wp-chatbot-hours-remove">'+
            '<button type="button" class="btn btn-danger btn-sm wp-chatbot-hours-remove-btn ">'+
            '<i class="fa fa-times" aria-hidden="true"></i>'+
            '</button>'+
            '</div>'+
            '</div>';
        $(this).parent().parent().find('.wp-chatbot-day').append(hourSet);
        $('.wp-chatbot-hours input').timepicker({ 'timeFormat': 'H:i' });
    });

    $(document).on('click','.wp-chatbot-hours-remove-btn',function () {
        var elNumbers=$(this).parent().parent().parent().find('.wp-chatbot-hours-container').length;
        if(elNumbers>1){
            if(confirm('Are you sure to delete this support query block?')){
                $(this).parent().parent().remove();
            }
        }else{
            alert('At least one opening hours set is required');
        }

    });
    //DialogFlow
    if($('#enable_wp_chatbot_dailogflow').is(':checked')){
        $('#wp-chatbot-dialflow-section').show();
    }else{
        $('#wp-chatbot-dialflow-section').hide();
    }
    $(document).on('change','#enable_wp_chatbot_dailogflow',function (e) {
        if($(this).is(':checked')){
            $('#wp-chatbot-dialflow-section').show();
        }else{
            $('#wp-chatbot-dialflow-section').hide();
        }
    })
	
	$('#submit').click(function(){

        if( jQuery('#section-flip-6:visible').length > 0 ){
            /* Perform some button action ... */
            if($('#enable_wp_chatbot_dailogflow').is(':checked')){
                
                if( $('input[name ="qlcd_wp_chatbot_dialogflow_project_id"]').val() =='' ){
                    alert("Please provide the Dialogflow Project ID!");
                    return false;
                }

                if( $('input[name="qlcd_wp_chatbot_dialogflow_agent_language"]').val() == '' ){
                    alert("Please provide the Dialogflow Agent Language!");
                    return false;
                }


            }

        }
    
    });

    jQuery( ".qc_menu_list_container ul li" ).dblclick(function(e) {
        e.preventDefault();
        var html = jQuery(this).html().trim();
        jQuery('#qc_menu_area').append(html);
        jQuery('#qc_wpbot_menu_order').val(jQuery('#qc_menu_area').html().trim());
    });


    jQuery(document).on("dblclick", "#qc_menu_area span", function(e) {
        e.preventDefault();
        jQuery(this).remove();
        jQuery('#qc_wpbot_menu_order').val(jQuery('#qc_menu_area').html().trim());
    });


    jQuery( "#qc_menu_area" ).sortable({
		update: function( event, ui ) {
			jQuery('#qc_wpbot_menu_order').val(jQuery('#qc_menu_area').html().trim());
		}
	});
    jQuery( "#qc_menu_area" ).disableSelection();

    
    jQuery('.qc_menu_list_area span').draggable({
        revert: "invalid",
        helper: 'clone'
    });

    

    
    jQuery('.qc_menu_area_container').droppable({
        accept: ".qc_draggable_item",
        drop: function(event, ui) {
          var droppable = $(this);
          var draggable = ui.draggable;
          // Move draggable into droppable
          draggable.clone().removeClass("qc_draggable_item").addClass("qc_draggable_item_remove").appendTo(droppable);
          jQuery('#qc_wpbot_menu_order').val(jQuery('#qc_menu_area').html().trim());
        }
      });
      $('#wp_chatbot_floatingiconbg_color, #wp_chatbot_text_color, #wp_chatbot_link_color,#wp_chatbot_link_hover_color,#wp_chatbot_bot_msg_bg_color,#wp_chatbot_bot_msg_text_color,#wp_chatbot_user_msg_bg_color,#wp_chatbot_header_background_color,#wp_chatbot_user_msg_text_color,#wp_chatbot_buttons_bg_color,#wp_chatbot_buttons_text_color,#wp_chatbot_theme_primary_color,#wp_chatbot_theme_secondary_color').wpColorPicker();
      jQuery('.qc_menu_list_area').droppable({
        accept: ".qc_draggable_item_remove",
        drop: function(event, ui) {
          var droppable = $(this);
          var draggable = ui.draggable;
          // Move draggable into droppable
          draggable.remove();
          jQuery('#qc_wpbot_menu_order').val(jQuery('#qc_menu_area').html().trim());
        }
      });
	  
	  
	jQuery('.qc_menu_area_container .qcld-chatbot-form').each(function(){
		var obj = $(this);
		obj.text(jQuery('.qc_menu_list_container .qcld-chatbot-form[data-form="'+obj.attr('data-form')+'"]').text());
	})

	setTimeout(function(){
        if( jQuery('#qc_wpbot_menu_order').length > 0 ){
            jQuery('#qc_wpbot_menu_order').val(jQuery('#qc_menu_area').html().trim());
        }
    }, 2000)
    
    jQuery('.qc_accordion_title').on('click', function(e){
        e.preventDefault();
        var obj = $(this);
        
        jQuery('.qc_accordion_content_third').hide();

        if($( "h3[data-accordion='qc_accordion_content_third']" ).find('i').hasClass("fa-minus")){
            $( "h3[data-accordion='qc_accordion_content_third']" ).find('i').removeClass("fa-minus");
            $( "h3[data-accordion='qc_accordion_content_third']" ).find('i').addClass("fa-plus");
        }
        jQuery('.qc_accordion_content_second').hide();
        if($( "h3[data-accordion='qc_accordion_content_second']" ).find('i').hasClass("fa-minus")){
            $( "h3[data-accordion='qc_accordion_content_second']" ).find('i').removeClass("fa-minus");
            $( "h3[data-accordion='qc_accordion_content_second']" ).find('i').addClass("fa-plus");
        }
        jQuery('.qc_accordion_content_first').hide();
        if($( "h3[data-accordion='qc_accordion_content_first']" ).find('i').hasClass("fa-minus")){
            $( "h3[data-accordion='qc_accordion_content_first']" ).find('i').removeClass("fa-minus");
            $( "h3[data-accordion='qc_accordion_content_first']" ).find('i').addClass("fa-plus");
        }
        setTimeout(function(){
            jQuery('.'+obj.attr('data-accordion')).show();
            obj.find('i').toggleClass("fa-plus fa-minus");
        }, 200)
    })

    $(document).ready(function () {
        var flieElementOpenAi = document.getElementById("openfileinput");
    
        if(flieElementOpenAi){
            $('.error-message').hide();
            $('.success-message').hide();
            $(".file_form").on('change','#openfileinput',function(){
                var file_data = $('#openfileinput').prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);
                form_data.append('action', 'openai_file_upload');
                form_data.append('purpose','answers');
                $('.success-message').html('File is Proccesing');
                $('.success-message').show();
                $.ajax({
                    url: ajax_object.ajax_url,
                    type: 'post',
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function (response) {
                        if(response[0].status == "success"){
                           // $('.success').html(response.message)
                            $('.success-message').hide();
                            $('.success-message').html(response[0].message);
                            $('.success-message').show();
                            setTimeout(function(){
                                $('.success-message').hide();
                            },5000); 
                            location.reload();
                        }
                        if(response[0].status === "error"){
                            //$('.success-message').html(response.message)
                            jQuery('.success-message').hide();
                            jQuery('.error-message').show();
                            jQuery('.error-message').html(response[0].message);
                            setTimeout(function(){
                                jQuery('.error-message').hide();
                            },5000); 
                            location.reload();
                        }
                    },  
                });
                
            });
    
            $("#openaiFileList").on('click','.remove_file_openai',function(){
                $(this).hide();
                var file_id = $('.remove_file_openai').attr('data-id');
                 jQuery('.error-message').show();
                    jQuery('.error-message').html(file_id+'is deleting');
                    setTimeout(function(){
                        jQuery('.error-message').hide();
                    },5000); 
                $.ajax({
                    url:  ajax_object.ajax_url,
                    type: 'POST',
                    dataType: "JSON",
                    data:  {
                        action : 'openai_file_delete',
                        file_id: file_id
                    },
                    success: function (response) {
                        location.reload();
                    },  
                });
                
            });
            $.ajax({
                url:  ajax_object.ajax_url,				
                type: "POST",
                dataType: "JSON",
                data: {
                    action : 'openai_file_list',
                },
                success: function(res) {
            
                    if((res.data != undefined)){
                        data = res.data;
                        let text = "";
                        data.forEach(itemfunction);
                        function itemfunction(item) {
                            text += '<tr><td>'+item.filename +'</td><td>' +item.id+'</td><td><a class="btn-success btn floated create_ft_model_modal" data-id="'+item.id+'">Create FT Model</a> <a class="btn-danger btn floated remove_file_openai" data-id="'+item.id+'">Remove</a></td></tr>';
                        }
                        document.getElementById("openaiFileList").innerHTML = text;
                    }
                }
            });
            $('#openaiFileList').on('click','.create_ft_model_modal',function(){
            
                var ft_id = $(this).attr('data-id');
                $('#qcld_openai_ft_fileid').val(ft_id);
                $('#qcld-ft-modal').modal();
            })
            $.ajax({
                url: ajax_object.ajax_url,					
                type: "POST",
                dataType: "JSON",
                data: {
                    action : 'openai_finetune_list',
                },
                success: function(res) {
                    data = res;
                    let text = "";
                    data.forEach(itemfunction);
                    function itemfunction(item) {
                        text += '<tr> <td>'+item[0] +'</td> <td>' +item[1]+'</td> <td>'+item[2]+'</td> <td>'+item[3]+'</td> <td>'+item[4]+'</td> <td> <a class="btn-danger btn floated remove_ft_model_openai" data-id="'+item[1]+'">Remove</a></td> </tr>';
                    }
                    document.getElementById("openaiFTList").innerHTML = text;
                
                }
            });
        }
 
        $("#wp-chatbot-data_post_converter").on('click','.qcld_convert_data', function(){
            var list = $("input[name='wp_chatbot_data_converter_list[]']:checked").map(function () {
                return this.value;
            }).get();
            $.ajax({
                url: ajax_object.ajax_url,					
                type: "POST",
                dataType: "JSON",
                data: {
                    action : 'qcld_openai_post_data_converter_count',
                    data: list,
                },
                success: function(res) {
                    location.reload();
                }
            });
        });
        
       
        
        // $('').on('click', '#save_setting', function(){
      
          
        // })
        var file_save = document.getElementById("save_file_id");
        if(file_save){
            $('.qcl-openai').on('click', '#save_file_id', function(){
                var file_id = $("input[name='file_id']" ).val();
                
                $.ajax({
                    url:  ajax_object.ajax_url,
                    type:'POST',
                    data:    ({action  : '',nonce: ajax_object.ajax_nonce,file_id:file_id}),
                    success: function(data){
                        $('#result').html(data);
                        location.reload();
                        
                    }
                });
            })
        }
        var settingsOpenAi = document.getElementById("save_setting");
        if(settingsOpenAi){
            document.getElementById("temperature").onchange = function() {
                var x = document.getElementById("temperature");
                x.value = x.value.toUpperCase();
                updateTemp( x.value);
            };
            function updateTemp(n){
                document.getElementById('temperatureout').textContent=n; 
            };
            document.getElementById("frequency_penalty").onchange = function() {
                var x = document.getElementById("frequency_penalty");
                x.value = x.value.toUpperCase();
                updateFpenalty( x.value);
            };
            function updateFpenalty(n){
                document.getElementById('frequency_penalty_out').textContent=n; 
            };
            document.getElementById("presence_penalty").onchange = function() {
                var x = document.getElementById("presence_penalty");
                x.value = x.value.toUpperCase();
                updatePpenalty( x.value);
            };
            function updatePpenalty(n){
                document.getElementById('presence_penalty_out').textContent=n; 
            };
        
            $('.qcl-openai').on('change','#qcld_openai_prompt', function() {
              
                if( ($("[id*='qcld_openai_prompt'] :selected").val()) == 'custom_prompt'){
                    $('#custom_prompt_wrapper').html('<input type="field" id="qcld_openai_prompt_custom" class="form-control my-2" placeholder="Add custom prompt here. Custom prompt will be appended before the user`s queries"/>');
                }else{
                    $('#custom_prompt_wrapper').empty('')
                }
            })
            setTimeout(() => {
                var custom_promt_value =$("#custom_promt_value").val();
                if( $("[id*='qcld_openai_prompt'] :selected").val() == 'custom_prompt' ){
                  
                   // $("#custom_promt_value").filter('[value=any_command]').prop('selected', true);
                    $('select option[value="custom_prompt"]').attr('selected', 'selected');
                   // $('select option[value="any_command"]').attr('selected', 'selected');
                  
                    $('#custom_prompt_wrapper').html('<input type="field" id="qcld_openai_prompt_custom" class="form-control my-2" />');
                    $('#qcld_openai_prompt_custom').val(custom_promt_value)
                   
                }
            }, 500);
            $('.qcl-openai').on('click', '#save_setting', function(){
                console.log($('#conversation_continuity').is(":checked"))
                if ($('#is_ai_enabled').is(":checked")){
                    var is_ai_enabled = 1;
                }else{
                    var is_ai_enabled = 0;
                }
                if($('#is_ai_only_mode').is(":checked")){
                    var is_ai_only_mode = 1; 
                }else{
                    var is_ai_only_mode = 0;
                }
                if($('#conversation_continuity').is(":checked")){
                    var conversation_continuity = 1; 
                }else{
                    var conversation_continuity = 0;
                }
                console.log(conversation_continuity)
                if($('#is_relevant_enabled').is(":checked")){
                    var is_relevant_enabled = 1; 
                }else{
                    var is_relevant_enabled = 0;
                }
                var api_key = $( "input[name='api_key']" ).val();
                var openai_engines = $("[id*='openai_engines'] :selected").val();
                var qcld_openai_prompt = $("[id*='qcld_openai_prompt'] :selected").val();
                var max_tokens = $("input[name='max_tokens']" ).val();
                var file_id = $("input[name='file_id']" ).val();
                var temperature = $("input[name='temperature']" ).val();
                var presence_penalty = $("input[name='presence_penalty']" ).val();
                var openai_exclude_keyword = jQuery('#qcld_openai_exclude_keyword').val();
                var openai_include_keyword = jQuery('#qcld_openai_include_keyword').val();
                if(qcld_openai_prompt == "custom_prompt"){
                    var qcld_openai_prompt_custom =  $("#qcld_openai_prompt_custom").val();
                }
                var frequency_penalty = $("input[name='frequency_penalty']" ).val();
                $.ajax({
                    url:  ajax_object.ajax_url,
                    type:'POST',
                    data:    ({action  : 'openai_settings_option',nonce: ajax_object.ajax_nonce,api_key: api_key,openai_engines:openai_engines,qcld_openai_prompt: qcld_openai_prompt,max_tokens:max_tokens,file_id:file_id,temperature:temperature,presence_penalty:presence_penalty,frequency_penalty:frequency_penalty,qcld_openai_prompt_custom: qcld_openai_prompt_custom,openai_exclude_keyword:openai_exclude_keyword,is_relevant_enabled:is_relevant_enabled,openai_include_keyword:openai_include_keyword,ai_enabled:is_ai_enabled,ai_only_mode: is_ai_only_mode,conversation_continuity:conversation_continuity}),
                    success: function(data){
                        $('#result').html(data);
                        location.reload();
                    }
				});
    
            })

            //Additional Code - 04-12-2023
            //For AI Enabled + Site Search Disabling
            $('.qcl-openai').on('click', '#save_setting_disable_ss', function(){

                console.log($('#conversation_continuity').is(":checked"))
                if ($('#is_ai_enabled').is(":checked")){
                    var is_ai_enabled = 1;
                }else{
                    var is_ai_enabled = 0;
                }
                if($('#is_ai_only_mode').is(":checked")){
                    var is_ai_only_mode = 1; 
                }else{
                    var is_ai_only_mode = 0;
                }
                if($('#conversation_continuity').is(":checked")){
                    var conversation_continuity = 1; 
                }else{
                    var conversation_continuity = 0;
                }
                console.log(conversation_continuity)
                if($('#is_relevant_enabled').is(":checked")){
                    var is_relevant_enabled = 1; 
                }else{
                    var is_relevant_enabled = 0;
                }
                var api_key = $( "input[name='api_key']" ).val();
                var openai_engines = $("[id*='openai_engines'] :selected").val();
                var qcld_openai_prompt = $("[id*='qcld_openai_prompt'] :selected").val();
                var max_tokens = $("input[name='max_tokens']" ).val();
                var file_id = $("input[name='file_id']" ).val();
                var temperature = $("input[name='temperature']" ).val();
                var presence_penalty = $("input[name='presence_penalty']" ).val();
                var openai_exclude_keyword = jQuery('#qcld_openai_exclude_keyword').val();
                var openai_include_keyword = jQuery('#qcld_openai_include_keyword').val();
                if(qcld_openai_prompt == "custom_prompt"){
                    var qcld_openai_prompt_custom =  $("#qcld_openai_prompt_custom").val();
                }
                var frequency_penalty = $("input[name='frequency_penalty']" ).val();

                $.ajax({
                    url:  ajax_object.ajax_url,
                    type:'POST',
                    data:    ({action  : 'openai_settings_option',nonce: ajax_object.ajax_nonce,api_key: api_key,openai_engines:openai_engines,qcld_openai_prompt: qcld_openai_prompt,max_tokens:max_tokens,file_id:file_id,temperature:temperature,presence_penalty:presence_penalty,frequency_penalty:frequency_penalty,qcld_openai_prompt_custom: qcld_openai_prompt_custom,openai_exclude_keyword:openai_exclude_keyword,is_relevant_enabled:is_relevant_enabled,openai_include_keyword:openai_include_keyword,ai_enabled:is_ai_enabled,ai_only_mode: is_ai_only_mode,conversation_continuity:conversation_continuity, disable_ss: 1}),
                    success: function(data){
                        $('#result').html(data);
                        location.reload();
                    }
                });

                

            }) //Additional Code - 04-12-2023 ends here
        }
    
        });
        
    $(document).on('click', '.qcld_botopenai_generate_image', function (e) {
        var qcld_seo_button             = $(this);
        var qcld_seo_prompt             = $('#prompt').val();
        var qcld_seo_artist             = $('#artist').val();
        var qcld_seo_art_style          = $('#art_style').val();
        var qcld_seo_photography_style  = $('#photography_style').val();
        var qcld_seo_lighting           = $('#lighting').val();
        var qcld_seo_subject            = $('#subject').val();
        var qcld_seo_camera_settings    = $('#camera_settings').val();
        var qcld_seo_composition        = $('#composition').val();
        var qcld_seo_resolution         = $('#resolution').val();
        var qcld_seo_color              = $('#color').val();
        var qcld_seo_special_effects    = $('#special_effects').val();
        var qcld_seo_img_size           = $('#img_size').val();
        var qcld_seo_num_images         = $('#num_images').val();

 
        if(qcld_seo_prompt === ''){
            alert('Something went wrong');
        }else{
           
            var qcld_seo_post_status = $('.qcld_seo-post-status:checked').val();
            var qcld_seo_schedule = $('.qcld_seo-schedule-post').val();

            var data = { 
                qcld_seo_prompt: qcld_seo_prompt,
                qcld_seo_artist: qcld_seo_artist,
                qcld_seo_art_style: qcld_seo_art_style,
                qcld_seo_photography_style: qcld_seo_photography_style,
                qcld_seo_lighting: qcld_seo_lighting,
                qcld_seo_subject: qcld_seo_subject,
                qcld_seo_camera_settings: qcld_seo_camera_settings,
                qcld_seo_composition: qcld_seo_composition,
                qcld_seo_resolution: qcld_seo_resolution,
                qcld_seo_color: qcld_seo_color,
                qcld_seo_special_effects: qcld_seo_special_effects,
                qcld_seo_img_size: qcld_seo_img_size,
                qcld_seo_num_images: qcld_seo_num_images,
                action: 'qcld_openai_image_generate',
                nonce: ajax_object.ajax_url,
            };
         
            $.ajax({
                url: ajax_object.ajax_url,
                data: data,
                type: 'POST',
                dataType: 'JSON',
                beforeSend: function(){
                    qcld_seo_button.attr('disabled','disabled');
                    qcld_seo_button.append('<span class="spinner"></span>');
                    qcld_seo_button.find('.spinner').css('visibility','unset');
                },
                success: function (res){
                    qcld_seo_button.removeAttr('disabled');
                    qcld_seo_button.find('.spinner').remove();
                    if(res.status === 'success'){
                       // window.location.href = qcld_seo_bulk_content + '&qcld_seo_track='+res.id
                        $('#qcld_seo-tab-generated-text').html( res.html );
                    }
                    else{
                        alert('Something went wrong');
                    }
                },
                error: function (){
                    qcld_seo_button.removeAttr('disabled');
                    qcld_seo_button.find('.spinner').remove();
                    alert('Something went wrong');
                }
            })
        }
    });
    $(document).on('click', '.qcld_botopenai_generate_image_download', function (e) {
        e.preventDefault();

            var url = $(this).find("img").attr('src'); 
            console.log(url)
            var qcld_seo_button = $(this);
            var image_url       = $(this).find('img').attr('src');
            var image_page_url  = $(this).find('img').attr('src');
            var photographer    = $(this).find('img').data('photographer');
            var q = '';
            var data = { 
                    qcld_seo_openai_images_upload   : "1",
                    image_url                       : image_url,
                    image_src_page                  : image_page_url,
                    image_user                      : photographer,
                    q                               : q,
                    action                          : 'qcld_openai_image_generate_url' 
                };
                $.ajax({
                    url: ajax_object.ajax_url,
                    data: data,
                    type: 'POST',
                    dataType: 'JSON',
                    beforeSend: function(){
                        qcld_seo_button.removeAttr('disabled').removeClass("uploading").find('.qcld_seo_msg').remove();
                        qcld_seo_button.attr('disabled','disabled');
                        qcld_seo_button.addClass('uploading').find('.qcld_seo_download img').replaceWith('');
                    },
                    success: function ( res ){
                        console.log(res.data.html);
                        qcld_seo_button.find('.qcld_seo_download img').replaceWith('<p class="qcld_seo_msg">'+res.data.html+'<p>' );
                        const newBlock = wp.blocks.createBlock( "core/image", {
                              id: res.data.attachment_id,
                              url: res.data.url,
                              width: res.data.width,
                              height: res.data.height,
                              sizeSlug: res.data.size,
                              alt: '',
                              title: '',
                              caption: '',
                        });
                        wp.data.dispatch("core/editor").insertBlocks(newBlock);
                    },
                    error: function (){
                        qcld_seo_button.removeAttr('disabled');
                    }
                })

    });

    $(document).on('click','#qcld_article_keyword_suggestion',function(e){
        var qcld_keyword_suggestion         = $('#qcld_article_keyword_suggestion_mf').val();
        var qcld_keyword_number             = $('#qcld_keyword_number').val();
        var qcld_article_language           = $('#qcld_article_language').val();
        var qcld_article_number_of_heading  = $('#qcld_article_number_of_heading').val();
        var qcld_article_heading_tag        = $('#qcld_article_heading_tag').val();
        var qcld_article_heading_style      = $('#qcld_article_heading_style').val();
        var qcld_article_heading_tone       = $('#qcld_article_heading_tone').val();
        var qcld_article_heading_img        = $('#qcld_article_heading_img').val();
        var qcld_article_heading_img        = $("input[name=qcld_article_heading_img]:checked").val();
        var qcld_article_heading_tagline    = $("input[name=qcld_article_heading_tagline]:checked").val();
        var qcld_article_heading_intro      = $("input[name=qcld_article_heading_intro]:checked").val();
        var qcld_article_heading_conclusion = $("input[name=qcld_article_heading_conclusion]:checked").val();
        var qcld_article_label_anchor_text  = $('#qcld_article_label_anchor_text').val();
        var qcld_article_target_url         = $('#qcld_article_target_url').val();
        var qcld_article_target_label_cta   = $('#qcld_article_target_label_cta').val();
        var qcld_article_cta_pos            = $('#qcld_article_cta_pos').val();
        var qcld_article_label_keywords     = $('#qcld_article_label_keywords').val();
        var qcld_article_label_word_to_avoid= $('#qcld_article_label_word_to_avoid').val();
        var qcld_article_label_keywords_bold= $("input[name=qcld_article_label_keywords_bold]:checked").val();
        var qcld_article_heading_faq        = $("input[name=qcld_article_heading_faq]:checked").val();
        var qcld_article_img_size           = $('#qcld_article_img_size').val();
    
        $('#qcld_article_keyword_suggestion').addClass('spinning');
        $('#qcld_article_keyword_suggestion').prop("disabled",true);
        $('#linkbait_article_keyword_data').html('');
        $.ajax({
          url: ajax_object.ajax_url,
          method: 'POST',
          data: {
              'action': 'openai_keyword_suggestion_content',
              'keyword'                         : qcld_keyword_suggestion,
              'keyword_number'                  : qcld_keyword_number,
              'qcld_article_language'           : qcld_article_language,
              'qcld_article_number_of_heading'  : qcld_article_number_of_heading,
              'qcld_article_heading_tag'        : qcld_article_heading_tag,
              'qcld_article_heading_style'      : qcld_article_heading_style,
              'qcld_article_heading_tone'       : qcld_article_heading_tone,
              'qcld_article_heading_img'        : qcld_article_heading_img,
              'qcld_article_heading_tagline'    : qcld_article_heading_tagline,
              'qcld_article_heading_intro'      : qcld_article_heading_intro,
              'qcld_article_heading_conclusion' : qcld_article_heading_conclusion,
              'qcld_article_label_anchor_text'  : qcld_article_label_anchor_text,
              'qcld_article_target_url'         : qcld_article_target_url,
              'qcld_article_target_label_cta'   : qcld_article_target_label_cta,
              'qcld_article_cta_pos'            : qcld_article_cta_pos,
              'qcld_article_label_keywords'     : qcld_article_label_keywords,
              'qcld_article_label_word_to_avoid': qcld_article_label_word_to_avoid,
              'qcld_article_label_keywords_bold': qcld_article_label_keywords_bold,
              'qcld_article_heading_faq'        : qcld_article_heading_faq,
              'qcld_article_img_size'           : qcld_article_img_size,
              //'selectedlanguage': selectedlanguage,
          },
          dataType: 'json',
          success: function(response) {
            //$('#linkbait_keyword_data').append(response.keywords);
            $('#qcld_article_keyword_suggestion').prop("disabled",false);
            $('#qcld_article_keyword_suggestion').removeClass('spinning');
            $('#linkbait_article_keyword_data').html('<div class="qcld_copied-content-wrap"><div class="qcld_copied-content_text btn d-none link-success">Copied</div><a class="btn btn-sm btn-secondary qcld-copied-content_text"><span class="dashicons dashicons-admin-page"></span></a></div><textarea id="qcld_content_result_msg" style="height: 20rem">' + response.keywords +'</textarea>');
            $('#linkbait_article_keyword_data').append('<div class="qcld_content_result_wrap"><div class="qcld_rewrite_result_count">' + response.keywords.split(" ").length +'</div></div>');
                    
            $('#qcld_content_result_msg').focus();
            $('#qcld_content_result_msg').focusout();
          }
        });

    });
    

});

