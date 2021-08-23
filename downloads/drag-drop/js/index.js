$.fn.dragAndDrop = function(p){
  var parameters = {
    'supported' : ['audio/wav','audio/mp3'],
    'size' : 5,
    'uploadFile' : 'upload.php',
    'sizeAlert' : 'File too heavy',
    'formatAlert' : 'Format not supported',
    'done' : function (msg) {
      console.info('upload done');
    },
    'error' : function (msg) {
      console.info('upload fail');
    },
    'onProgress' : function(progress){
      console.info(Math.round(progress * 100)+'%');
    }
  };

  $.extend(parameters,p);

  function upload(fd){
    $.ajax({
      type: 'POST',
      url: parameters.uploadFile,
      data: fd,
      processData: false,
      contentType: false,
      xhr: function()
      {
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener("progress", function(evt){
          if (evt.lengthComputable) {
            var percentComplete = evt.loaded / evt.total;
            parameters.onProgress(percentComplete);
          }
        }, false);
        return xhr;
      },
    }).done(parameters.done).error(parameters.error);
  }

  this.each(function(){
    var $this = $(this);

    $this.find('.dndAlternative').on('click',function(e){
      e.preventDefault();
      $this.find('input[type="file"]').trigger('click');
    });

    $this.find('input[type="file"]').on('change',function(){
      fd = new FormData();
      fd.append('data', $(this)[0].files[0]);
      upload(fd); 
    });


    $this.on({
      dragcenter : function(e){
        e.preventDefault();
      },
      dragover : function(e){
        e.preventDefault();
        $this.addClass('hover');       
      },
      dragleave : function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        $this.removeClass('hover');
      },
      drop : function(e){
        e.preventDefault();

        $this.removeClass('hover');

        var files = e.originalEvent.dataTransfer.files;

        fd = new FormData();
        fd.append('data', files[0]);

        if($.inArray(files[0].type,parameters.supported) < 0){
          alert(parameters.formatAlert);
          return false; 
        }

        if(files[0].size > parameters.size*1038336 ){
          alert(parameters.sizeAlert);
          return false; 
        }

        upload(fd);
      }
    });
  });
}

$('#dnd').dragAndDrop({
  'done' : function(msg){
    $('#dnd .start, #dnd .error,#dnd progress').hide();
    $('#dnd .done').show();
    console.info(msg);
  }, 
  'error' : function(){
    $('#dnd .start,#dnd .done,#dnd progress').hide();
    $('.error').show();
  },
  'onProgress' : function(p){
    $('#dnd .start,#dnd .done,#dnd .error').hide();
    $('#dnd progress').show().val(Math.round(p * 100));
  }
});