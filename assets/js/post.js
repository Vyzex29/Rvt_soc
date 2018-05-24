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
                            });

   $('.postimg').each(function () {
                    this.src = $(this).attr('data-tempsrc')
                    this.onload = function () {
                        this.style.opacity = '1';
                        this.style.width = '100%';
                    }
                });