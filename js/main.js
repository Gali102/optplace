var user_id, user_name, dialogs;

function createCaretPlacer(atStart) {
    return function(el) {
        el.focus();
        if (typeof window.getSelection != "undefined"
                && typeof document.createRange != "undefined") {
            var range = document.createRange();
            range.selectNodeContents(el);
            range.collapse(atStart);
            var sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
        } else if (typeof document.body.createTextRange != "undefined") {
            var textRange = document.body.createTextRange();
            textRange.moveToElementText(el);
            textRange.collapse(atStart);
            textRange.select();
        }
    };
}

var placeCaretAtStart = createCaretPlacer(true);
var placeCaretAtEnd = createCaretPlacer(false);

function handleFiles(files) {
    console.log(files);

    for(var i = 0; i < files.length; i++) {
        var file = files[i];
        var reader = new FileReader();
        reader.onload = function (e) {
            var text = $('#chat-text');
            text.html(
                text.html() + '<img class="image" src="' + e.target.result + '">'
            );
        };
        reader.readAsDataURL(file);
    }
}

function checkNoty() {
    $.post(
        '/index.php/events/checknoty',
        {},
        function (data) {
            data = JSON.parse(data);
            data.noty = JSON.parse(data.noty);

            if(data.noty.length) {
                document.querySelector('#sound-alert').play();
                
                for(i in data.noty) {
                    $('.alert-stack').append(
                        '<div class="alert alert-warning">\
                            ' + data.noty[i] + '\
                            <a href="#" class="ml-2 close" data-dismiss="alert">&times;</a>\
                        </div>'
                    );
                }
            }

            $('.badge-events_all').html(data.events_all);
            $('.badge-event_today').html(data.event_today);
            $('.badge-event_vazhnoe').html(data.event_vazhnoe);
            $('.badge-mymail').html(data.mymail);
        }
    );
}

function buildChat(data) {
    var res = '';
    data.forEach(function (el) {
        var toMe = '';
        var reg = new RegExp(user_name.replace(/\s/ig, '_'), 'i');
        if(el.text.replace(/\s/ig, '_').match(reg)) {
            toMe = 'to-me';
        }

        res += '<div class="chat-message\
            ' + (user_id == el.user_id ? ' my' : '') + '\
            ' + toMe + '"\
            data-date="' + el.date + '"\
            data-name="' + el.user_name + '">\
            <div class="chat-message-header">\
                <div class="chat-name">' + (user_id == el.user_id ? '' : '') + el.user_name + '</div>\
                <div class="chat-date">' + el.date_print + '</div>\
            </div>\
            <div class="chat-text">' + el.text + '</div>\
        </div>';
    });
    return res;
}

function getChat(force = 0) {
    var lastMessage = $('.chat-message:last-child');
    var date = '';

    if(lastMessage.length) {
        date = lastMessage.data('date');
    }

    $.post(
        '/index.php/chat/getchat',
        {
            date: date,
            poluch_id: $('#poluch_id').val() || 0,
            page: location.href
        },
        function (data) {
            data = JSON.parse(data);

            $('.badge-chat').html(data.length && !location.href.match(/chat/) ? data.length : '');

            if($('.chat-data').length) {
                $('.chat-data').html(
                    $('.chat-data').html() + buildChat(data)
                );

                var lastName = '';
                $('.chat-message').each(function () {
                    if($(this).data('name') == lastName) {
                        $(this).find('.chat-message-header').remove();
                    }
                    lastName = $(this).data('name');
                });

                if(force || lastName == user_name) {
                    scrollChat();
                }
            }
        }
    );
}

function buildDialogs(data) {
    var res = '';
    var active = $('#poluch_id').val() == 0;

    res += '<div class="chat-dialog ' + (active ? ' active' : '') + '"\
        data-with="0">\
        <div class="chat-dialog-header">\
            <div class="chat-with"><i class="fa fa-star"></i> Общий</div>\
        </div>\
    </div>'

    data.forEach(function (el, i) {
        var my = el.with_id != user_id;
        var fromMe = el.user_id != el.with_id;
        var active = $('#poluch_id').val() == el.with_id;
        res += '<div class="chat-dialog' + (my ? ' my' : '') + (active ? ' active' : '') + '"\
            data-i="' + i + '"\
            data-with="' + el.with_id + '">\
            <div class="chat-dialog-header">\
                <div class="chat-with"><i class="fa fa-star"></i> ' + el.with_name + '</div>\
                <!--<div class="chat-date">' + el.date_print + '</div>-->\
            </div>\
            <div class="chat-text">' + (fromMe ? '<span class="text-primary">Вы:</span> ' : '') + el.text + '</div>\
        </div>';
    });
    return res;
}

function getDialogs() {
    $.post(
        '/index.php/chat/getdialogs',
        {},
        function (data) {
            data = JSON.parse(data);

            $('.chat-dialogs').html(
                buildDialogs(data)
            );

            var dialogs = {};
            
            $('[data-with]').each(function (i) {
                var with_id = $(this).data('with');

                var anchor = $('[data-with="' + with_id + '"]').first();
                $('[data-with="' + with_id + '"]').each(function () {
                    if($(this).data('i') > anchor.data('i')) {
                        $(this).remove();
                    }
                });
            });
        }
    );
}

function buildUsers(data) {
    var res = '';
    data.forEach(function (el) {
        res += '<div class="chat-user' + (user_id == el.user_id ? ' my' : '') + '"\
            data-id="' + el.user_id + '"\
            data-name="' + el.user_name + '">\
            <a class="new-dialog" title="Диалог"><i class="fa fa-comments"></i></a>\
            <div>\
                <div class="users-name">' + (user_id == el.user_id ? '<i class="fa fa-user"></i> ' : '') + el.user_name + '</div>\
                <div class="users-date" data-date="' + el.online + '">был(а) ' + el.online_print + '</div>\
            </div>\
        </div>';
    });
    return res;
}

function getUsers() {
    $.post(
        '/index.php/chat/getusers',
        {},
        function (data) {
            data = JSON.parse(data);
            $('.users-data').html(buildUsers(data));
        }
    );
}

function postChat() {
    var text = $('#chat-text').html().trim();
    $('#chat-text').html('');
    $('.chat-smiles').removeClass('active');

    if(text) {
        $.post(
            '/index.php/chat/post',
            {
                text: text,
                poluch_id: $('#poluch_id').val()
            },
            function (data) {
                getChat(1);
            }
        );
    }
}

function replyUser(name) {
    var input = document.querySelector('#chat-text');
    input.innerHTML =  input.innerHTML + ' @' + name.replace(/\s/ig, '_') + ', ';

    placeCaretAtEnd(input);
}

function scrollChat() {
    setTimeout(function () {
        $('html, body').scrollTop(0);
        $('.chat-data').scrollTop(99999);
    }, 250);
}

$(document).ready(function() {
    user_id = $('[name="user_id"]').val();
    user_name = $('[name="user_name"]').val();

    setInterval(function () {
        checkNoty();
    }, 5000);

    setInterval(function () {
        getChat();
    }, 5000);

    if($('.chat-dialogs').length) {
        setInterval(function () {
            getDialogs();
        }, 5000);
    }

    if($('.chat').length) {
        setInterval(function () {
            getUsers();
        }, 15000);
    }

    $('#chat-send').click(function () {
        postChat();
    });

    $('#chat-text').keydown(function (ev) {
        var isShift = !!ev.shiftKey;

        if(!isShift && ev.which == 13) {
            postChat();
            return false;
        }
    });

    $('body').on('click', '.chat-message', function () {
        var name = $(this).data('name');
        replyUser(name)
    });

    $('body').on('click', '.chat-user', function () {
        var name = $(this).data('name');
        replyUser(name);
    });

    $('body').on('click', '.chat-dialog', function () {
        var dwith = $(this).data('with');
        $('#poluch_id').val(dwith);
        $('.chat-data').html('');
        getDialogs();
        getChat(1);
    });

    $('body').on('click', '.new-dialog', function () {
        var id = $(this).closest('.chat-user').data('id');
        $('#poluch_id').val(id);
        $('.chat-data').html('');
        getDialogs();
        getChat(1);
        return false;
    });
    
    $('.chat-smiles img').click(function () {
        var input = document.querySelector('#chat-text');
        input.innerHTML =  input.innerHTML + '<img class="smile" src="' + $(this).attr('src') + '">';
    
        placeCaretAtEnd(input);
    });

    $('#smiles-open').click(function () {
        $('.chat-smiles').toggleClass('active');
    });

    $('#image-upload').click(function () {
        $('#chat-files').click();
    });

    $('.menu [href*="chat"]').append('<span class="badge badge-count badge-chat"></span>');
    $('.menu [href*="events_all"]').append('<span class="badge badge-count badge-events_all"></span>');
    $('.menu [href*="event_vazhnoe"]').append('<span class="badge badge-count badge-event_vazhnoe"></span>');
    $('.menu [href*="event_today"]').append('<span class="badge badge-count badge-event_today"></span>');
    $('.menu [href*="mymail"]').append('<span class="badge badge-count badge-mymail"></span>');

    scrollChat();
    checkNoty();
    getChat(1);
    getDialogs();
    getUsers();

});