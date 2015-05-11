<?php
include('main_header.php');
include('header.php');
?>

    <div class="content container">
        <div class="row">

            <div class="col s12 m12 l10 offset-l1">
                <div class="card white z-depth-2 stats">
                    <div class="card-content no-padding">
                        <h4 class="card-title center">
                            Салыштыруу
                        </h4>

                        <div class="row">
                            <form class="col s12 l10 offset-l1 song-form">
                                <div class="row">
                                    <div class="input-field center col s12 m6 l6">
                                        <select disabled>
                                            <option value="" disabled selected hidden>Ырчы тандыңыз</option>
                                            <option value="1" selected="">Ырчынын аты</option>
                                            <option value="2">Ырчынын аты</option>
                                            <option value="3">Ырчынын аты</option>
                                        </select>
                                        <label>Ырчы</label>
                                    </div>
                                    <div class="input-field center col s12 m6 l6">
                                        <select>
                                            <option value="" disabled selected hidden>Ырчы тандыңыз</option>
                                            <option value="1">Ырчынын аты</option>
                                            <option value="2">Ырчынын аты</option>
                                            <option value="3">Ырчынын аты</option>
                                        </select>
                                        <label>Ырчы</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field center">
                                        <button class="btn waves-effect waves-light" type="submit" name="action">Салыштыр
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12 m12 l10 offset-l1">
                <div class="card white z-depth-2 compare radios">
                    <div class="card-content no-padding ">
                        <h4 class="card-title center-align">
                            <span class="col l5 m5 s5">Тынчтыкбек Кожобеков</span>
                            <span class="col l2 m2 s2 vert-divider center">
                                <i class="mdi-action-star-rate"></i>
                            </span>
                            <span class="col l5 m5 s5">Гулнур Сатылганова</span>

                            <div class="clearfix"></div>
                        </h4>
                        <div class="card-panel col l8 offset-l2 m10 offset-m1 s10 offset-s1 clearfix">

                            <div class="row center">
                                <div class="progress progress-left progress-win">
                                    <div class="determinate" style="width: 20%">
                                        <div class="pin">
                                            <span class="">0%</span>
                                        </div>
                                    </div>
                                </div>
                                <a class="waves-effect waves-light btn btn-large btn-floating">
                                    <img src="images/radios/obon.png" alt=""/>
                                </a>
                                <div class="progress progress-right progress-lost">
                                    <div class="determinate" style="width: 70%">
                                        <div class="pin">
                                            <span class="">12%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row center">
                                <div class="progress progress-left progress-win">
                                    <div class="determinate" style="width: 20%">
                                        <div class="pin">
                                            <span class="">0%</span>
                                        </div>
                                    </div>
                                </div>
                                <a class="waves-effect waves-light btn btn-large btn-floating">
                                    <img src="images/radios/mkfm.jpg" alt=""/>
                                </a>
                                <div class="progress progress-right progress-lost">
                                    <div class="determinate" style="width: 70%">
                                        <div class="pin">
                                            <span class="">12%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row center">
                                <div class="progress progress-left progress-win">
                                    <div class="determinate" style="width: 20%">
                                        <div class="pin">
                                            <span class="">0%</span>
                                        </div>
                                    </div>
                                </div>
                                <a class="waves-effect waves-light btn btn-large btn-floating">
                                    <img src="images/radios/almaz.jpg" alt=""/>
                                </a>
                                <div class="progress progress-right progress-lost">
                                    <div class="determinate" style="width: 70%">
                                        <div class="pin">
                                            <span class="">12%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row center">
                                <div class="progress progress-left progress-win">
                                    <div class="determinate" style="width: 20%">
                                        <div class="pin">
                                            <span class="">0%</span>
                                        </div>
                                    </div>
                                </div>
                                <a class="waves-effect waves-light btn btn-large btn-floating">
                                    <img src="images/radios/tumar.jpg" alt=""/>
                                </a>
                                <div class="progress progress-right progress-lost">
                                    <div class="determinate" style="width: 70%">
                                        <div class="pin">
                                            <span class="">12%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row divider-row">
                                <div class="divider"></div>
                            </div>


                            <div class="row center total">
                                <h6 class="total-left teal-text">45%</h6>
                                <a class="waves-effect waves-light btn btn-large btn-floating teal btn-left">
                                    <i class="mdi-action-thumb-up"></i>
                                </a>
                                <a class="waves-effect waves-light btn btn-large btn-floating red lighten-2">
                                    <i class="mdi-action-accessibility"></i>
                                </a>
                                <a class="waves-effect waves-light btn btn-large btn-floating custom-red btn-right">
                                    <i class="mdi-action-thumb-down"></i>
                                </a>
                                <h6 class="total-right custom-red-text">55%</h6>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

<?php include('footer.php'); ?>