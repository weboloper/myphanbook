<div class="card mb-3">
  <img src="https://placekitten.com/1200/300" class="card-img-top">
  <div class="card-body">
    <div class="row">
    <div class="col-4 col-sm-2">
        <img   src="{{ getAvatarSrc(user.avatar) }}" class="img-thumbnail img-fluid">
    </div>
    <div class="col-8 col-sm-10">
    <h4 class="card-title">{{ user.getFullName() }}</h4>
    <p class="card-text">{{ this.markdown.text(user.bio) }}</p>
    <ul class="nav">
        <li class="nav-item"><span class="nav-link pl-0">{{ totalQuestions }} posts</span></li>
        <li class="nav-item"><span class="nav-link">{{ totalReply }} comments</span></li>
        <li class="nav-item"><span class="nav-link">{{ user.getHumanKarma() }} karma</span></li>
    </ul>
    <p class="card-text"><small class="text-muted">Joined {{ user.getHumanCreatedAt() }}</small></p>
    </div>
    </div>
  </div>
</div>


<div class="col-md-9">
    <div class="row">
        <div class="user-profile">
            <div class="col-md-12">
                <div class="page-content page-content-user-profile">
                    <div class="user-profile-widget">
                         <div class="ul_list ul_list-icon-ok">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="?tab=questions" class="nav-link"><i class="icon-question-mark"></i> Questions
                                        <span> ( <span>{{ totalQuestions }}</span> )
                                    </span>
                                </a></li>
                                <li class="nav-item">
                                    <a href="?tab=answers" class="nav-link"><i class="fa fa-comment"></i> Answers
                                    <span> ( <span>{{ totalReply }}</span> ) </span>
                                </a></li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"><i class="fa fa-star"></i> Favorite Questions
                                    <span> ( <span>3</span> ) </span>
                                </a></li>
                                <li class="nav-item">
                                    <a href="" class="nav-link"><i class="fa fa-heart"></i> Karma
                                    <span> ( <span>{{ user.getHumanKarma() }}</span> ) </span>
                                </a></li>
                            </ul>
                        </div>
                    </div><!-- End user-profile-widget -->
                </div><!-- End page-content -->
            </div><!-- End col-md-12 -->
        
        </div><!-- End user-profile -->
    </div><!-- End row -->
    <div class="clearfix"></div>
    <div class="page-content page-content-user">
        <div class="user-questions">
            {{ partial('partials/list-posts') }}
        </div>
    </div>

    <div class="height_20"></div>
    {{ partial('partials/pagination') }}
    <!-- if no questions
    <p>No questions yet</p>
    -->
</div><!-- End main -->
<aside class="col-md-3 sidebar">
    
    <div class="user-profile-widget">
        <h2>User Badges</h2>
        <div class="ul_list ul_list-icon-ok">
            <ul>
                {% for badge in user.badges %}
                <li><i class="fa fa-trophy"></i>
                    <a href="">{{ badge.badge }}
                    </a>
                </li>
                {% endfor %}
            </ul>
        </div>
    </div><!-- End user-profile-widget -->

</aside>
