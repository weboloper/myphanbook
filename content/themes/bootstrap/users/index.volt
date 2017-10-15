<div class="container">
    <div class="col-md-12">
        <ul class="p-0 row">
                {% for user in paginator.items %}
                        <li class="card col-md-2 col-sm-4 col-12 p-0 ">
                            <a href="/@{{user.username}}"><img class="card-img-top"  src="{{ getAvatarSrc(user.avatar) }}" /></a>
                                <div class="card-body">
                                    <p class="card-text"><strong>{{ user.getFullName() | capitalize }}</strong> </br>
                                     <small class="text-muted">Joined on {{ date('M d,Y', user.getCreatedAt())}}</small></p>
                            </div>
                        </li>
                  {% endfor %}
                 </ul>
           <!-- /.control-box -->
    </div><!-- /.col-xs-12 -->
    
    {{ partial('partials/pagination')}}
 </div><!-- /.container -->
