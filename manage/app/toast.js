function info_noti(message){
       $.toast({
            heading: 'Mission Shakti, Uttar Pradesh',
            text:message,
            position: 'top-center',
            loaderBg:'#ff6849',
            icon: 'info',
            hideAfter: 3000, 
            stack: 6
          });
    }    

    function warning_noti(message, uname){
       $.toast({
            heading: uname,
            text:message,
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'warning',
            hideAfter: 3000, 
            stack: 6
          });
    }        

    function success_noti(message, uname){
       $.toast({
       
            heading: uname,
            text:message,
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3000, 
            stack: 6
          });
    }            