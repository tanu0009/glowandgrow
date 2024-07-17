/*currPage=$(location).attr('href').split('?')[0].split('/');currPage=currPage[currPage.length-1];currPageNm=currPage.substr(0,currPage.length-4);currPageAdd=currPage.substr(0,currPage.length-7);currPageEdit=currPage.substr(0,currPage.length-8);
function valAdd(){$.validate({modules:'file,security',form:'#addform',scrollToTopOnError:false,onSuccess:function(){$('#addform button[type=submit]').button('loading');$('#addform button[type=reset]').attr('disabled','disabled');$('.note-danger').html('').hide();$.ajax({type:'POST',url:currPageAdd+'add_save.php',data:new FormData($('#addform')[0]),contentType:false,processData:false,success:function(data){if(data=='success'){$('#addform')[0].reset();location=currPageAdd+'.php?msg=add_success';}else if(data.substr(data.length-4)=='.php')location=data;else{$('.note-danger').html(data).show();$('#addform button[type=submit]').button('reset');$('#addform button[type=reset]').removeAttr('disabled');}}});return false;}});}valAdd();
function valEdit(){$.validate({modules:'file,security',form:'#updateform',scrollToTopOnError:false,onSuccess:function(){$('#updateform button[type=submit]').button('loading');$('#updateform button[type=reset]').attr('disabled','disabled');$('.note-danger').html('').hide();$.ajax({type:'POST',url:currPageEdit+'edit_save.php',data:new FormData($('#updateform')[0]),contentType:false,processData:false,success:function(data){if(data=='success'){location=currPageEdit+'.php?msg=update_success';}else if(data.substr(data.length-4)=='.php')location=data;else{$('.note-danger').html(data).show();$('#updateform button[type=submit]').button('reset');$('#updateform button[type=reset]').removeAttr('disabled');}}});return false;}});}valEdit();
$('.delbtn').click(function(){if(confirm('Confirm?')){$this=$(this);if(($this.html()).indexOf('Disable')!=-1)btnval='n';else btnval='y';$.post(currPageNm+'_lock.php',{action:btnval,id:$this.val()},function(data){if(data=='y')$this.html('Disable<i class="fa fa-close mlm"></i>').removeClass('btn-success').addClass('btn-danger');else if(data=='n')$this.html('Enable<i class="fa fa-check mlm"></i>').removeClass('btn-danger').addClass('btn-success');else if(data.substr(data.length-4)=='.php')location=data;else alert(data);});}else return false;});*/

 currPage = $(location).attr('href').split('?')[0].split('/');
currPage = currPage[currPage.length - 1];
currPageNm = currPage.substr(0, currPage.length - 4);
currPageAdd = currPage.substr(0, currPage.length - 7);
currPageEdit = currPage.substr(0, currPage.length - 8);

function valAdd() {
	
    $.validate({
        modules: 'file,security',
        form: '#addform',
        scrollToTopOnError: false,
        onSuccess: function() {
			
			for(instance in CKEDITOR.instances)CKEDITOR.instances[instance].updateElement();
            $('#addform button[type=submit]').button('loading');
            $('#addform button[type=reset]').attr('disabled', 'disabled');
            $('.note-danger').html('').hide();
            $.ajax({
                type: 'POST',
                url: currPageAdd + 'add_save.php',
                data: new FormData($('#addform')[0]),
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.trim() == 'success') {
                        $('#addform')[0].reset();
                        location = currPageAdd + '.php?msg=add_success';
                    } else if (data.substr(data.length - 4) == '.php') location = data;
                    else {
                        $('.note-danger').html(data).show();
                        $('#addform button[type=submit]').button('reset');
                        $('#addform button[type=reset]').removeAttr('disabled');
                    }
                }
            });
            return false;
        }
    });
}
valAdd();


function valAdd_new() {
    $.validate({
        modules: 'file,security',
        form: '#addformNew',
        scrollToTopOnError: false,
        onSuccess: function() {
			$('#addformNew button[type=submit]').button('loading');
            $('#addformNew button[type=reset]').attr('disabled', 'disabled');
            $('.note-danger').html('').hide();
            $.ajax({
                type: 'POST',
                url: currPageAdd + 'add_save.php',
                data: new FormData($('#addformNew')[0]),
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.trim() == 'success') {
                        $('#addformNew')[0].reset();
                        location = currPageAdd + '.php?msg=add_success';
                    } else if (data.substr(data.length - 4) == '.php') location = data;
                    else {
                        $('.note-danger').html(data).show();
                        $('#addformNew button[type=submit]').button('reset');
                        $('#addformNew button[type=reset]').removeAttr('disabled');
                    }
                }
            });
            return false;
        }
    });
}
valAdd_new();

function valEditNew() {
    $.validate({
        modules: 'file,security',
        form: '#updateformNew',
        scrollToTopOnError: false,
        onSuccess: function() {
			$('#updateformNew button[type=submit]').button('loading');
            $('#updateformNew button[type=reset]').attr('disabled', 'disabled');
            $('.note-danger').html('').hide();
            $.ajax({
                type: 'POST',
                url: currPageEdit + 'edit_save.php',
                data: new FormData($('#updateformNew')[0]),
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.trim() == 'success') {
                        location = currPageEdit + '.php?msg=update_success';
                    } else if (data.substr(data.length - 4) == '.php') location = data;
                    else {
                        $('.note-danger').html(data).show();
                        $('#updateformNew button[type=submit]').button('reset');
                        $('#updateformNew button[type=reset]').removeAttr('disabled');
                    }
                }
            });
            return false;
        }
    });
}
valEditNew();



function valEdit() {
    $.validate({
        modules: 'file,security',
        form: '#updateform',
        scrollToTopOnError: false,
        onSuccess: function() {
			for(instance in CKEDITOR.instances)CKEDITOR.instances[instance].updateElement();
            $('#updateform button[type=submit]').button('loading');
            $('#updateform button[type=reset]').attr('disabled', 'disabled');
            $('.note-danger').html('').hide();
            $.ajax({
                type: 'POST',
                url: currPageEdit + 'edit_save.php',
                data: new FormData($('#updateform')[0]),
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.trim() == 'success') {
                        location = currPageEdit + '.php?msg=update_success';
                    } else if (data.substr(data.length - 4) == '.php') location = data;
                    else {
                        $('.note-danger').html(data).show();
                        $('#updateform button[type=submit]').button('reset');
                        $('#updateform button[type=reset]').removeAttr('disabled');
                    }
                }
            });
            return false;
        }
    });
}
valEdit();

$('.delbtn').click(function() {
    if (confirm('Confirm?')) {
        $this = $(this);
        if (($this.html()).indexOf('Disable') != -1) btnval = 'n';
        else btnval = 'y';
        $.post(currPageNm + '_lock.php', {
            action: btnval,
            id: $this.val()
        }, function(data) {
            if (data == 'y') $this.html('Disable<i class="fa fa-close mlm"></i>').removeClass('btn-success').addClass('btn-danger');
            else if (data == 'n') $this.html('Enable<i class="fa fa-check mlm"></i>').removeClass('btn-danger').addClass('btn-success');
            else if (data.substr(data.length - 4) == '.php') location = data;
            else alert(data);
        });
    } else return false;
});

$('.homebtn').click(function() {
    if (confirm('Confirm?')) {
        $this = $(this);
        if (($this.html()).indexOf('Show') != -1) btnval = 'y';
        else btnval = 'n';
        $.post('gallery_home.php', {
            action: btnval,
            id: $this.val()
        }, function(data) {
            if (data == 'n') $this.html('Show<i class="fa fa-close mlm"></i>').removeClass('btn-success').addClass('btn-danger');
            else if (data == 'y') $this.html('Hide<i class="fa fa-check mlm"></i>').removeClass('btn-danger').addClass('btn-success');
            else if (data.substr(data.length - 4) == '.php') location = data;
            else alert(data);
        });
    } else return false;
});

$('.galbtn').click(function() {
    if (confirm('Confirm?')) {
        $this = $(this);
        if (($this.html()).indexOf('Show') != -1) btnval = 'y';
        else btnval = 'n';
        $.post('gallery_show.php', {
            action: btnval,
            id: $this.val()
        }, function(data) {
            if (data == 'n') $this.html('Show<i class="fa fa-close mlm"></i>').removeClass('btn-success').addClass('btn-danger');
            else if (data == 'y') $this.html('Hide<i class="fa fa-check mlm"></i>').removeClass('btn-danger').addClass('btn-success');
            else if (data.substr(data.length - 4) == '.php') location = data;
            else alert(data);
        });
    } else return false;
});

$('.homebtn_n').click(function() {
    if (confirm('Confirm?')) {
        $this = $(this);
        if (($this.html()).indexOf('Show') != -1) btnval = 'y';
        else btnval = 'n';
        $.post('about.php', {
            action: btnval,
            id: $this.val()
        }, function(data) {
            if (data == 'n') $this.html('Show<i class="fa fa-close mlm"></i>').removeClass('btn-success').addClass('btn-danger');
            else if (data == 'y') $this.html('Hide<i class="fa fa-check mlm"></i>').removeClass('btn-danger').addClass('btn-success');
            else if (data.substr(data.length - 4) == '.php') location = data;
            else alert(data);
        });
    } else return false;
});