    var username = document.getElementById("user").className;
    var start = 5;
    var working = false;
    $(window).scroll(function () {
        if ($(this).scrollTop() + 1 >= $('body').height() - $(window).height()) {
            if (working == false) {
                working = true;
                $.ajax({

                    type: "GET",
                    url: "api/profileposts?username=" + username + "&start=" + start,
                    processData: false,
                    contentType: "application/json",
                    data: '',
                    success: function (r) {
                        var posts = JSON.parse(r)
                        $.each(posts, function (index) {

                            if (posts[index].PostImage == "") {

                                $('.timelineposts').html(
                                    $('.timelineposts').html() +

                                    '<li class="list-group-item" id="' + posts[index].PostId + '"><blockquote><p>' + posts[index].PostBody + '</p><footer>Posted by ' + posts[index].PostedBy + ' on ' + posts[index].PostDate + '<button class="btn btn-default" type="button" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;" data-id=\"' + posts[index].PostId + '\"> <span class="glyphicon glyphicon-heart" ></span> ' + posts[index].Likes + ' Likes</span></button><button class="btn btn-default comment" data-postid=\"' + posts[index].PostId + '\" type="button" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-flash" style="color:#f9d616;"></i><span style="color:#f9d616;"> Comments</span></button></footer><a href="post.php?id='+posts[index].PostId+'">Read More </a></blockquote></li>'
                                )
                            } else {
                                $('.timelineposts').html(
                                    $('.timelineposts').html() +

                                    '<li class="list-group-item" id="' + posts[index].PostId + '"><blockquote><p>' + posts[index].PostBody + '</p><img src="" data-tempsrc="' + posts[index].PostImage + '" class="postimg" id="img' + posts[index].postId + '"><footer>Posted by ' + posts[index].PostedBy + ' on ' + posts[index].PostDate + '<button class="btn btn-default" type="button" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;" data-id=\"' + posts[index].PostId + '\"> <span class="glyphicon glyphicon-heart" ></span> ' + posts[index].Likes + ' Likes</span></button><button class="btn btn-default comment" data-postid=\"' + posts[index].PostId + '\" type="button" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-flash" style="color:#f9d616;"></i><span style="color:#f9d616;"> Comments</span></button></footer><a href="post.php?id='+posts[index].PostId+'">Read More </a></blockquote></li>'
                                )
                            }

                            $('[data-postid]').click(function () {
                                var buttonid = $(this).attr('data-postid');

                                $.ajax({

                                    type: "GET",
                                    url: "api/comments?postid=" + buttonid,
                                    processData: false,
                                    contentType: "application/json",
                                    data: '',
                                    success: function (r) {
                                        var res = JSON.parse(r)
                                        showCommentsModal(res,buttonid);
                                    },
                                    error: function (r) {
                                        console.log(r)
                                    }

                                });
                            });

                            $('[data-id]').click(function () {
                                var buttonid = $(this).attr('data-id');
                                $.ajax({

                                    type: "POST",
                                    url: "api/likes?id=" + $(this).attr('data-id'),
                                    processData: false,
                                    contentType: "application/json",
                                    data: '',
                                    success: function (r) {
                                        var res = JSON.parse(r)
                                        $("[data-id='" + buttonid + "']").html(' <span class="glyphicon glyphicon-heart" ></span> ' + res.Likes + ' Likes</span>')
                                    },
                                    error: function (r) {
                                        console.log(r)
                                    }

                                });
                            })
                        })

                        $('.postimg').each(function () {
                            this.src = $(this).attr('data-tempsrc')
                            this.onload = function () {
                                this.style.opacity = '1';
                                this.style.width = '100%';
                            }
                        })

                        scrollToAnchor(location.hash)

                        start += 5;
                        setTimeout(function () {
                            working = false;
                        }, 4000)

                    },
                    error: function (r) {
                        console.log(r)
                    }

                });
            }
        }
    })

    function scrollToAnchor(aid) {
        try {
            var aTag = $(aid);
            $('html,body').animate({
                scrollTop: aTag.offset().top
            }, 'slow');
        } catch (error) {
            console.log(error)
        }
    }

    $(document).ready(function () {
        $.ajax({

            type: "GET",
            url: "api/profileposts?username=" + username + "&start=0",
            processData: false,
            contentType: "application/json",
            data: '',
            success: function (r) {
                var posts = JSON.parse(r)
                $.each(posts, function (index) {

                    if (posts[index].PostImage == "") {

                        $('.timelineposts').html(
                            $('.timelineposts').html() +

                            '<li class="list-group-item" id="' + posts[index].PostId + '"><blockquote><p>' + posts[index].PostBody + '</p><footer>Posted by ' + posts[index].PostedBy + ' on ' + posts[index].PostDate + '<button class="btn btn-default" type="button" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;" data-id=\"' + posts[index].PostId + '\"> <span class="glyphicon glyphicon-heart" ></span> ' + posts[index].Likes + ' Likes</span></button><button class="btn btn-default comment" data-postid=\"' + posts[index].PostId + '\" type="button" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-flash" style="color:#f9d616;"></i><span style="color:#f9d616;"> Comments</span></button></footer><a href="post.php?id='+posts[index].PostId+'">Read More </a></blockquote></li>'
                        )
                    } else {
                        $('.timelineposts').html(
                            $('.timelineposts').html() +

                            '<li class="list-group-item" id="' + posts[index].PostId + '"><blockquote><p>' + posts[index].PostBody + '</p><img src="" data-tempsrc="' + posts[index].PostImage + '" class="postimg" id="img' + posts[index].postId + '"><footer>Posted by ' + posts[index].PostedBy + ' on ' + posts[index].PostDate + '<button class="btn btn-default" type="button" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;" data-id=\"' + posts[index].PostId + '\"> <span class="glyphicon glyphicon-heart" ></span> ' + posts[index].Likes + ' Likes</span></button><button class="btn btn-default comment" data-postid=\"' + posts[index].PostId + '\" type="button" style="color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;"><i class="glyphicon glyphicon-flash" style="color:#f9d616;"></i><span style="color:#f9d616;"> Comments</span></button></footer>'+
                            '<a href="post.php?id='+posts[index].PostId+'">Read More </a></blockquote></li>'
                        )
                    }

                    $('[data-postid]').click(function () {
                        var buttonid = $(this).attr('data-postid');

                        $.ajax({

                            type: "GET",
                            url: "api/comments?postid=" + buttonid,
                            processData: false,
                            contentType: "application/json",
                            data: '',
                            success: function (r) {
                                var res = JSON.parse(r)
                                showCommentsModal(res,buttonid);
                            },
                            error: function (r) {
                                console.log(r)
                            }

                        });
                    });

                    $('[data-id]').click(function () {
                        var buttonid = $(this).attr('data-id');
                        $.ajax({

                            type: "POST",
                            url: "api/likes?id=" + $(this).attr('data-id'),
                            processData: false,
                            contentType: "application/json",
                            data: '',
                            success: function (r) {
                                var res = JSON.parse(r)
                                $("[data-id='" + buttonid + "']").html(' <span class="glyphicon glyphicon-heart" ></span><span> ' + res.Likes + ' Likes</span>')
                            },
                            error: function (r) {
                                console.log(r)
                            }

                        });
                    })
                })

                $('.postimg').each(function () {
                    this.src = $(this).attr('data-tempsrc')
                    this.onload = function () {
                        this.style.opacity = '1';
                        this.style.width = '100%';
                    }
                })

                //scrollToAnchor(location.hash)

            },
            error: function (r) {
                console.log(r)
            }

        });

    });

    function showNewPostModal() {
        $('#newpost').modal('show')
    }

    function showCommentsModal(res,buttonId) {
        $('#commentsmodal').modal('show')
        var output = "";
        for (var i = 0; i < res.length; i++) {
            output += res[i].Comment;
            output += " ~ ";
            output += res[i].CommentedBy;
            output += "<hr />";
        }     
        $('.modal-body').html(output)        
    }
