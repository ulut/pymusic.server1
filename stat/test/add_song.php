<?php
include('main_header.php');
include('header.php');
?>

    <div class="content container">
        <div class="row">

            <div class="col s12 m12 l10 offset-l1">
                <div class="card white z-depth-2 radios">
                    <div class="card-content no-padding">
                        <h4 class="card-title center">
                            Ыр кош
                        </h4>

                        <div class="row">
                            <form class="col s12 l10 offset-l1 m10 offset-m1 song-form">
                                <div class="row">
                                    <div class="input-field center col s12 m6 l6">
                                        <select>
                                            <option value="" disabled selected hidden>Ырчы тандыңыз</option>
                                            <option value="1">Ырчынын аты</option>
                                            <option value="2">Ырчынын аты</option>
                                            <option value="3">Ырчынын аты</option>
                                        </select>
                                        <label>Ырчы</label>
                                    </div>
                                    <div class="input-field col s12 m6 l6">
                                        <input placeholder="" id="" type="text" class="validate">
                                        <label for="">Ырдын аты</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m6 l6">
                                        <input placeholder="" id="" type="text" class="validate">
                                        <label for="">Ырдын сѳзүн жазган акын</label>
                                    </div>
                                    <div class="input-field col s12 m6 l6">
                                        <input placeholder="" id="" type="text" class="validate">
                                        <label for="">Композитор</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m6 l6">
                                        <input placeholder="" id="" type="text" class="validate">
                                        <label for="">Аранжировщик</label>
                                    </div>
                                    <div class="input-field col s12 m6 l6">
                                        <input placeholder="" id="" type="text" class="validate">
                                        <label for="">Yн режиссёр</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12 m6 l6">
                                        <input placeholder="" id="" type="text" class="validate">
                                        <label for="">Жылы</label>
                                    </div>
                                    <div class="input-field col s12 m6 l6">
                                        <input placeholder="" id="" type="text" class="validate">
                                        <label for="">Жанр</label>
                                    </div>
                                </div>
                                <div class="file-field input-field">
                                    <input class="file-path validate" type="text"/>
                                    <div class="btn">
                                        <span>файл</span>
                                        <input type="file" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field center">
                                        <button class="btn waves-effect waves-light" type="submit" name="action">Жүктѳ
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php include('footer.php'); ?>