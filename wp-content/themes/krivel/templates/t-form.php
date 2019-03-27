<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
            <h2>Контакты</h2>
            <hr>
        </div>
        <div class="col-md-5 col-md-offset-3">
            <!-- contact form starts -->
            <h4 style="text-align: center;">Написать нам</h4>
            <a class="white" href="tel:<?php the_field('phone', 'option') ?>">Тел.:<em><?php the_field('phone', 'option') ?></em></a>
            <a class="white" href="malito:<?php the_field('e-mail', 'option') ?>">Email.:<em><?php the_field('e-mail', 'option') ?></em></a>


            <!-- // Тел.:: <em>+7 902 7600974</em>
            // <br>
            // Email.:: <em>alex-mishel@bk.ru</em> -->
            <div id="sp_quickcontact98" class="sp_quickcontact">
            <div id="sp_qc_status" style="display: none;"><p class="sp_qc_success">Сообщение отправлено!</p></div>
                <form id="sp-quickcontact-form" data-target="feedback">
                    <fieldset>
                        <div class="form-group">
                            <div class="col-sm-8">
                                <input type="text" placeholder="Имя" class="form-control reset" name="name" id="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8">
                                <input type="email" placeholder="Email" class="form-control reset" name="email" id="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8">
                                <input type="text" placeholder="Тема" class="form-control reset" name="subject" id="subject">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8">
                                <textarea placeholder="Сообщение" class="form-control reset" name="message" id="message" rows="3"></textarea>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="form-group">
                            <div class="col-sm-8">
                                <input type="text" name="sccaptcha" class="form-control reset" onfocus="if (this.value=='3 + 4 = ?') this.value='';"
                                    onblur="if (this.value=='') this.value='3 + 4 = ?';" value="3 + 4 = ?" required="">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8">
                                <button type="submit" id="sp_qc_submit" class="btn btn-success">Отправить</button>
                            </div>
                        </div>
                        <input type="hidden" name="echo" value="Ваше сообщение отправлено!">
                    </fieldset>
                </form>
            </div>
            <div class="clear"></div>
            <form action="contact" id="contact-form" class="form-horizontal" novalidate="novalidate">

            </form>

            <!-- contact form ends -->
        </div>
    </div>
</div>