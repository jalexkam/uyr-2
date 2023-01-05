module.exports = {
    //Get Slug
   
    

        onlyNumric(evt){
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
              evt.preventDefault();
            }
            else
            {
              return true;
            }
        },
    hashkey: function () {
        var randomstring = Math.random().toString(36).slice(-8);
         return randomstring;
    },
    isMobile() {
        var width =
            window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        if (
            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                navigator.userAgent
            ) ||
            width < 768
        ) {
            return true;
        } else {
            return false;
        }
    },

    VueMetaData(metaData) {
       
    },

    getPrice: function (val) {
        if (val >= 10000000) {
            val = (val / 10000000).toFixed(2);
            var num1 = val.split('.');
            if (num1[1] > 0) {
                var val = val + ' Cr';
            } else {
                var val = num1[0] + ' Cr';
            }
        } else if (val >= 100000) {
            var val = (val / 100000).toFixed(2);
            var num1 = val.split('.');
            if (num1[1] > 0) {
                var val = val + ' Lacs';
            } else {
                var val = num1[0] + ' Lacs';
            }
            //val = (val/100000).toFixed(2) + ' Lacs';
        } else if (val >= 1000) {
            var val = (val / 1000).toFixed(2);
            var num1 = val.split('.');
            if (num1[1] > 0) {
                var val = val + ' K';
            } else {
                var val = num1[0] + ' K';
            }
            //val = (val/1000).toFixed(2) + ' K';
        }
        return val;
    },

    isPhone: function (val) {
        if (
            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                navigator.userAgent
            )
        ) {
            return true;
        } else {
            return false;
        }
    },

    
};
