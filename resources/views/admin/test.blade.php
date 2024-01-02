@include('admin/header')
@include('admin/navbar')

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Order Outs List</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-block">
                                    <div class="wrapper wrapper-640">
                                        <form action="#" method="post" class="j-forms" id="j-forms" novalidate>
                                            <div class="content">
                                                <div class="divider-text gap-top-20 gap-bottom-45">
                                                    <span>Cloning with widget addons</span>
                                                </div>
                                                <div class="clone-widget">
                                                    <div class="unit widget left-50 right-50 toclone">
                                                        <div class="input">
                                                            <input type="text">
                                                        </div>
                                                        <button type="button" class="addon-btn adn-50 adn-left delete">
                                                            <i class="icofont icofont-minus"></i>
                                                        </button>
                                                        <button type="button" class="addon-btn adn-50 adn-right clone">
                                                            <i class="icofont icofont-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="divider-text gap-top-45 gap-bottom-45">
                                                    <span>Cloning with buttons</span>
                                                </div>
                                                <div class="clone-rightside-btn-1">
                                                    <label class="label">Right side buttons</label>
                                                    <div class="j-row toclone-widget-right toclone">
                                                        <div class="span6 unit">
                                                            <div class="input">
                                                                <input type="text" placeholder="first name">
                                                            </div>
                                                        </div>
                                                        <div class="span6 unit">
                                                            <div class="input">
                                                                <input type="text" placeholder="last name">
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-primary clone-btn-right clone">
                                                            <i class="icofont icofont-plus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-default clone-btn-right delete">
                                                            <i class="icofont icofont-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="clone-rightside-btn-2">
                                                    <div class="unit toclone-widget-right toclone">
                                                        <div class="input">
                                                            <input type="email" placeholder="email">
                                                        </div>
                                                        <button type="button" class="btn btn-primary clone-btn-right clone">
                                                            <i class="icofont icofont-plus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-default clone-btn-right delete">
                                                            <i class="icofont icofont-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="clone-leftside-btn-1">
                                                    <label class="label">Left side buttons</label>
                                                    <div class="j-row toclone-widget-left toclone">
                                                        <div class="span6 unit">
                                                            <div class="input">
                                                                <input type="text" placeholder="first name">
                                                            </div>
                                                        </div>
                                                        <div class="span6 unit">
                                                            <div class="input">
                                                                <input type="text" placeholder="last name">
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-primary clone-btn-left clone">
                                                            <i class="icofont icofont-plus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-default clone-btn-left delete">
                                                            <i class="icofont icofont-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="clone-leftside-btn-2">
                                                    <div class="unit toclone-widget-left toclone">
                                                        <div class="input">
                                                            <input type="email" placeholder="email">
                                                        </div>
                                                        <button type="button" class="btn btn-primary clone-btn-left clone">
                                                            <i class="icofont icofont-plus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-default clone-btn-left delete">
                                                            <i class="icofont icofont-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="divider-text gap-top-45 gap-bottom-45">
                                                    <span>Cloning with links</span>
                                                </div>
                                                <div class="clone-link">
                                                    <div class="toclone">
                                                        <button class=" clone btn btn-primary m-b-15">add new person</button>
                                                        <button class=" delete  btn btn-danger m-b-15">delete a person</button>
                                                        <div class="j-row">
                                                            <div class="span6 unit">
                                                                <div class="input">
                                                                    <input type="text" placeholder="first name">
                                                                </div>
                                                            </div>
                                                            <div class="span6 unit">
                                                                <div class="input">
                                                                    <input type="text" placeholder="last name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="unit">
                                                            <div class="input">
                                                                <input type="email" placeholder="email">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="footer">
                                                <button type="submit" class="btn btn-primary m-b-0">Send</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('admin/footer')