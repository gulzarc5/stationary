@extends('web.templet.master')

  {{-- @include('web.include.seo') --}}

  @section('seo')
    <meta name="description" content="Assambigmart">
  @endsection

  @section('content')
        <!-- site__body -->
        <div class="site__body">
            <div class="block-header block-header--has-breadcrumb block-header--has-title">
                <div class="container-fluid">
                    <div class="block-header__body">
                        <nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
                            <ol class="breadcrumb__list">
                                <li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
                                <li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{route('web.index')}}" class="breadcrumb__item-link">Home</a></li>
                                <li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Catagory</span></li>
                                <li class="breadcrumb__title-safe-area" role="presentation"></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="block-split block-split--has-sidebar">
                <div class="container-fluid">
                    <div class="block-split__row row no-gutters">
                    	<!-- Left Sidebar -->
                        <div class="block-split__item block-split__item-sidebar col-auto">
                            <div class="sidebar sidebar--offcanvas--mobile">
                                <div class="sidebar__backdrop"></div>
                                <div class="sidebar__body">
                                    <div class="sidebar__header">
                                        <div class="sidebar__title">Filters</div>
                                        <button class="sidebar__close" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12">
                                                <path d="M10.8,10.8L10.8,10.8c-0.4,0.4-1,0.4-1.4,0L6,7.4l-3.4,3.4c-0.4,0.4-1,0.4-1.4,0l0,0c-0.4-0.4-0.4-1,0-1.4L4.6,6L1.2,2.6
												c-0.4-0.4-0.4-1,0-1.4l0,0c0.4-0.4,1-0.4,1.4,0L6,4.6l3.4-3.4c0.4-0.4,1-0.4,1.4,0l0,0c0.4,0.4,0.4,1,0,1.4L7.4,6l3.4,3.4
												C11.2,9.8,11.2,10.4,10.8,10.8z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="sidebar__content">
                                        <div class="widget widget-filters widget-filters--offcanvas--mobile" data-collapse data-collapse-opened-class="filter--opened">
                                            <!-- <div class="widget__header widget-filters__header">
                                                <h4>Catagories</h4>
                                            </div> -->
                                            <div class="widget-filters__list">
                                                <div class="widget-filters__item">
                                                    <div class="filter filter--opened" data-collapse-item>
                                                        <button type="button" class="filter__title" data-collapse-trigger>DISPOSABLE PRODUCTS <span class="filter__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="12px" height="7px"><path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"/></svg></span></button>
                                                        <div class="filter__body" data-collapse-content>
                                                            <div class="filter__container">
                                                                <div class="filter-categories">
                                                                    <ul class="filter-categories__list">
                                                                        <li class="filter-categories__item filter-categories__item--child"><a href="#">Drills & Mixers</a>
                                                                            <div class="filter-categories__counter">15</div>
                                                                        </li>
                                                                        <li class="filter-categories__item filter-categories__item--child"><a href="#">Cordless Screwdrivers</a>
                                                                            <div class="filter-categories__counter">2</div>
                                                                        </li>
                                                                        <li class="filter-categories__item filter-categories__item--child"><a href="#">Screwdrivers</a>
                                                                            <div class="filter-categories__counter">30</div>
                                                                        </li>
                                                                        <li class="filter-categories__item filter-categories__item--child"><a href="#">Wrenches</a>
                                                                            <div class="filter-categories__counter">7</div>
                                                                        </li>
                                                                        <li class="filter-categories__item filter-categories__item--child"><a href="#">Grinding Machines</a>
                                                                            <div class="filter-categories__counter">5</div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="filter" data-collapse-item>
                                                        <button type="button" class="filter__title" data-collapse-trigger>HOUSEKEEPING PRODUCTS <span class="filter__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="12px" height="7px"><path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"/></svg></span></button>
                                                        <div class="filter__body" data-collapse-content>
                                                            <div class="filter__container">
                                                                <div class="filter-categories">
                                                                    <ul class="filter-categories__list">
                                                                        <li class="filter-categories__item filter-categories__item--child"><a href="#">Drills & Mixers</a>
                                                                            <div class="filter-categories__counter">15</div>
                                                                        </li>
                                                                        <li class="filter-categories__item filter-categories__item--child"><a href="#">Cordless Screwdrivers</a>
                                                                            <div class="filter-categories__counter">2</div>
                                                                        </li>
                                                                        <li class="filter-categories__item filter-categories__item--child"><a href="#">Screwdrivers</a>
                                                                            <div class="filter-categories__counter">30</div>
                                                                        </li>
                                                                        <li class="filter-categories__item filter-categories__item--child"><a href="#">Wrenches</a>
                                                                            <div class="filter-categories__counter">7</div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="filter" data-collapse-item>
                                                        <button type="button" class="filter__title" data-collapse-trigger>PACKAGING MATERIAL <span class="filter__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="12px" height="7px"><path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"/></svg></span></button>
                                                        <div class="filter__body" data-collapse-content>
                                                            <div class="filter__container">
                                                                <div class="filter-categories">
                                                                    <ul class="filter-categories__list">
                                                                        <li class="filter-categories__item filter-categories__item--child"><a href="#">Drills & Mixers</a>
                                                                            <div class="filter-categories__counter">15</div>
                                                                        </li>
                                                                        <li class="filter-categories__item filter-categories__item--child"><a href="#">Cordless Screwdrivers</a>
                                                                            <div class="filter-categories__counter">2</div>
                                                                        </li>
                                                                        <li class="filter-categories__item filter-categories__item--child"><a href="#">Screwdrivers</a>
                                                                            <div class="filter-categories__counter">30</div>
                                                                        </li>
                                                                        <li class="filter-categories__item filter-categories__item--child"><a href="#">Wrenches</a>
                                                                            <div class="filter-categories__counter">7</div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="filter" data-collapse-item>
                                                        <button type="button" class="filter__title" data-collapse-trigger>STATIONERY <span class="filter__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="12px" height="7px"><path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"/></svg></span></button>
                                                        <div class="filter__body" data-collapse-content>
                                                            <div class="filter__container">
                                                                <div class="filter-categories">
                                                                    <ul class="filter-categories__list">
                                                                        <li class="filter-categories__item filter-categories__item--child"><a href="#">Drills & Mixers</a>
                                                                            <div class="filter-categories__counter">15</div>
                                                                        </li>
                                                                        <li class="filter-categories__item filter-categories__item--child"><a href="#">Cordless Screwdrivers</a>
                                                                            <div class="filter-categories__counter">2</div>
                                                                        </li>
                                                                        <li class="filter-categories__item filter-categories__item--child"><a href="#">Screwdrivers</a>
                                                                            <div class="filter-categories__counter">30</div>
                                                                        </li>
                                                                        <li class="filter-categories__item filter-categories__item--child"><a href="#">Wrenches</a>
                                                                            <div class="filter-categories__counter">7</div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-filters__item">
                                                    <div class="filter filter--opened" data-collapse-item>
                                                        <button type="button" class="filter__title" data-collapse-trigger>Price <span class="filter__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="12px" height="7px"><path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"/></svg></span></button>
                                                        <div class="filter__body" data-collapse-content>
                                                            <div class="filter__container">
                                                                <div class="filter-price" data-min="100" data-max="2500" data-from="590" data-to="2499">
                                                                    <div class="filter-price__slider"></div>
                                                                    <div class="filter-price__title-button">
                                                                        <div class="filter-price__title">$<span class="filter-price__min-value"></span> – $<span class="filter-price__max-value"></span></div>
                                                                        <button type="button" class="btn btn-xs btn-secondary filter-price__button">Filter</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-filters__item">
                                                    <div class="filter filter--opened" data-collapse-item>
                                                        <button type="button" class="filter__title" data-collapse-trigger>Brand <span class="filter__arrow"><svg xmlns="http://www.w3.org/2000/svg" width="12px" height="7px"><path d="M0.286,0.273 L0.286,0.273 C-0.070,0.629 -0.075,1.204 0.276,1.565 L5.516,6.993 L10.757,1.565 C11.108,1.204 11.103,0.629 10.747,0.273 L10.747,0.273 C10.385,-0.089 9.796,-0.086 9.437,0.279 L5.516,4.296 L1.596,0.279 C1.237,-0.086 0.648,-0.089 0.286,0.273 Z"/></svg></span></button>
                                                        <div class="filter__body" data-collapse-content>
                                                            <div class="filter__container">
                                                                <div class="filter-list">
                                                                    <div class="filter-list__list">
                                                                        <label class="filter-list__item"><span class="input-check filter-list__input"><span class="input-check__body"><input class="input-check__input" type="checkbox"> <span class="input-check__box"></span> <span class="input-check__icon"><svg xmlns="http://www.w3.org/2000/svg" width="9px" height="7px"><path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/></svg> </span></span>
                                                                            </span><span class="filter-list__title">Wakita </span><span class="filter-list__counter">7</span></label>

                                                                        <label class="filter-list__item"><span class="input-check filter-list__input"><span class="input-check__body"><input class="input-check__input" type="checkbox" checked="checked"> <span class="input-check__box"></span> <span class="input-check__icon"><svg xmlns="http://www.w3.org/2000/svg" width="9px" height="7px"><path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/></svg> </span></span>
                                                                            </span><span class="filter-list__title">Zosch </span><span class="filter-list__counter">42</span></label>
                                                                       	
                                                                        <label class="filter-list__item"><span class="input-check filter-list__input"><span class="input-check__body"><input class="input-check__input" type="checkbox"> <span class="input-check__box"></span> <span class="input-check__icon"><svg xmlns="http://www.w3.org/2000/svg" width="9px" height="7px"><path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/></svg> </span></span>
                                                                            </span><span class="filter-list__title">Mitasia </span><span class="filter-list__counter">1</span></label>
                                                                        <label class="filter-list__item"><span class="input-check filter-list__input"><span class="input-check__body"><input class="input-check__input" type="checkbox"> <span class="input-check__box"></span> <span class="input-check__icon"><svg xmlns="http://www.w3.org/2000/svg" width="9px" height="7px"><path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/></svg> </span></span>
                                                                            </span><span class="filter-list__title">Metaggo </span><span class="filter-list__counter">25</span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-filters__actions d-flex">
                                                <button class="btn btn-primary btn-sm">Filter</button>
                                                <button class="btn btn-secondary btn-sm">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Main Content -->
                        <div class="block-split__item block-split__item-content col-auto">
                            <div class="block">
                                <div class="products-view">
                                    <div class="products-view__options view-options view-options--offcanvas--mobile">
                                        <div class="view-options__body">
                                            <button type="button" class="view-options__filters-button filters-button"><span class="filters-button__icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"><path d="M7,14v-2h9v2H7z M14,7h2v2h-2V7z M12.5,6C12.8,6,13,6.2,13,6.5v3c0,0.3-0.2,0.5-0.5,0.5h-2
											C10.2,10,10,9.8,10,9.5v-3C10,6.2,10.2,6,10.5,6H12.5z M7,2h9v2H7V2z M5.5,5h-2C3.2,5,3,4.8,3,4.5v-3C3,1.2,3.2,1,3.5,1h2
											C5.8,1,6,1.2,6,1.5v3C6,4.8,5.8,5,5.5,5z M0,2h2v2H0V2z M9,9H0V7h9V9z M2,14H0v-2h2V14z M3.5,11h2C5.8,11,6,11.2,6,11.5v3
											C6,14.8,5.8,15,5.5,15h-2C3.2,15,3,14.8,3,14.5v-3C3,11.2,3.2,11,3.5,11z"/></svg> </span><span class="filters-button__title">Filters</span> <span class="filters-button__counter">3</span></button>
                                            <div class="view-options__layout layout-switcher">
                                                <div class="layout-switcher__list">
                                                    <button type="button" class="layout-switcher__button layout-switcher__button--active" data-layout="grid" data-with-features="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                                            <path d="M15.2,16H9.8C9.4,16,9,15.6,9,15.2V9.8C9,9.4,9.4,9,9.8,9h5.4C15.6,9,16,9.4,16,9.8v5.4C16,15.6,15.6,16,15.2,16z M15.2,7
															H9.8C9.4,7,9,6.6,9,6.2V0.8C9,0.4,9.4,0,9.8,0h5.4C15.6,0,16,0.4,16,0.8v5.4C16,6.6,15.6,7,15.2,7z M6.2,16H0.8
															C0.4,16,0,15.6,0,15.2V9.8C0,9.4,0.4,9,0.8,9h5.4C6.6,9,7,9.4,7,9.8v5.4C7,15.6,6.6,16,6.2,16z M6.2,7H0.8C0.4,7,0,6.6,0,6.2V0.8
															C0,0.4,0.4,0,0.8,0h5.4C6.6,0,7,0.4,7,0.8v5.4C7,6.6,6.6,7,6.2,7z" />
                                                        </svg>
                                                    </button>
                                                    <button type="button" class="layout-switcher__button" data-layout="table" data-with-features="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
                                                            <path d="M15.2,16H0.8C0.4,16,0,15.6,0,15.2v-2.4C0,12.4,0.4,12,0.8,12h14.4c0.4,0,0.8,0.4,0.8,0.8v2.4C16,15.6,15.6,16,15.2,16z
															 M15.2,10H0.8C0.4,10,0,9.6,0,9.2V6.8C0,6.4,0.4,6,0.8,6h14.4C15.6,6,16,6.4,16,6.8v2.4C16,9.6,15.6,10,15.2,10z M15.2,4H0.8
															C0.4,4,0,3.6,0,3.2V0.8C0,0.4,0.4,0,0.8,0h14.4C15.6,0,16,0.4,16,0.8v2.4C16,3.6,15.6,4,15.2,4z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="view-options__legend product-list-title">Disposible Glasses</div>
                                            <div class="view-options__spring"></div>
                                            <div class="view-options__select">
                                                <label for="view-option-sort">Sort:</label>
                                                <select id="view-option-sort" class="form-control form-control-sm" name="">
                                                    <option value="">Relevant</option>
                                                    <option value="">Newest</option>
                                                    <option value="">Price- High to Low</option>
                                                    <option value="">Price- Low to High</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="products-view__list products-list products-list--grid--4" data-layout="grid" data-with-features="false">
                                        <div class="products-list__head">
                                            <div class="products-list__column products-list__column--image">Image</div>
                                            <div class="products-list__column products-list__column--meta">SKU</div>
                                            <div class="products-list__column products-list__column--product">Product</div>
                                            <div class="products-list__column products-list__column--price">Price</div>
                                        </div>
                                        <div class="products-list__content">
                                            <div class="products-list__item">
		                                        <div class="product-card">
		                                            <div class="product-card__actions-list">
		                                                <button class="product-card__action product-card__action--quickview" type="button" aria-label="Add to wish list">
		                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
		                                                        <path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7
																l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z" />
		                                                    </svg>
		                                                </button>
		                                            </div>
		                                            <div class="product-card__image">
		                                                <a href="{{route('web.product.shop-detail')}}"><img src="{{asset('web/images/products/1a.jpg')}}" alt=""></a>
		                                            </div>
		                                            <div class="product-card__info">
		                                                <div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 140-10440-B</div>
		                                                <div class="product-card__name">
		                                                    <div>
		                                                        <a href="{{route('web.product.shop-detail')}}">Brandix Spark Plug Kit ASR-400111</a>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="product-card__footer">
		                                                <div class="product-card__prices">
		                                                    <div class="product-card__price product-card__price--old">$21.00</div>
		                                                    <div class="product-card__price product-card__price--current">$19.00</div>
		                                                </div>
		                                                <a class="product-card__addtocart-icon" aria-label="Add to cart" href="{{route('web.product.shop-detail')}}">
		                                                    <i class="fa fa-arrow-right"></i>
		                                                </a>
		                                            </div>
		                                        </div>
                                            </div>
                                            <div class="products-list__item">
		                                        <div class="product-card">
		                                            <div class="product-card__actions-list">
		                                                <button class="product-card__action product-card__action--quickview" type="button" aria-label="Add to wish list">
		                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
		                                                        <path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7
																l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z" />
		                                                    </svg>
		                                                </button>
		                                            </div>
		                                            <div class="product-card__image">
		                                                <a href="{{route('web.product.shop-detail')}}"><img src="{{asset('web/images/products/2a.jpg')}}" alt=""></a>
		                                            </div>
		                                            <div class="product-card__info">
		                                                <div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 140-10440-B</div>
		                                                <div class="product-card__name">
		                                                    <div>
		                                                        <a href="{{route('web.product.shop-detail')}}">Brandix Spark Plug Kit ASR-400111</a>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="product-card__footer">
		                                                <div class="product-card__prices">
		                                                    <div class="product-card__price product-card__price--old">$21.00</div>
		                                                    <div class="product-card__price product-card__price--current">$19.00</div>
		                                                </div>
		                                                <a class="product-card__addtocart-icon" aria-label="Add to cart" href="{{route('web.product.shop-detail')}}">
		                                                    <i class="fa fa-arrow-right"></i>
		                                                </a>
		                                            </div>
		                                        </div>
                                            </div>
                                            <div class="products-list__item">
		                                        <div class="product-card">
		                                            <div class="product-card__actions-list">
		                                                <button class="product-card__action product-card__action--quickview" type="button" aria-label="Add to wish list">
		                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
		                                                        <path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7
																l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z" />
		                                                    </svg>
		                                                </button>
		                                            </div>
		                                            <div class="product-card__image">
		                                                <a href="{{route('web.product.shop-detail')}}"><img src="{{asset('web/images/products/3a.jpg')}}" alt=""></a>
		                                            </div>
		                                            <div class="product-card__info">
		                                                <div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 140-10440-B</div>
		                                                <div class="product-card__name">
		                                                    <div>
		                                                        <a href="{{route('web.product.shop-detail')}}">Brandix Spark Plug Kit ASR-400111</a>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="product-card__footer">
		                                                <div class="product-card__prices">
		                                                    <div class="product-card__price product-card__price--old">$21.00</div>
		                                                    <div class="product-card__price product-card__price--current">$19.00</div>
		                                                </div>
		                                                <a class="product-card__addtocart-icon" aria-label="Add to cart" href="{{route('web.product.shop-detail')}}">
		                                                    <i class="fa fa-arrow-right"></i>
		                                                </a>
		                                            </div>
		                                        </div>
                                            </div>
                                            <div class="products-list__item">
		                                        <div class="product-card">
		                                            <div class="product-card__actions-list">
		                                                <button class="product-card__action product-card__action--quickview" type="button" aria-label="Add to wish list">
		                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
		                                                        <path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7
																l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z" />
		                                                    </svg>
		                                                </button>
		                                            </div>
		                                            <div class="product-card__image">
		                                                <a href="{{route('web.product.shop-detail')}}"><img src="{{asset('web/images/products/4a.jpg')}}" alt=""></a>
		                                            </div>
		                                            <div class="product-card__info">
		                                                <div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 140-10440-B</div>
		                                                <div class="product-card__name">
		                                                    <div>
		                                                        <a href="{{route('web.product.shop-detail')}}">Brandix Spark Plug Kit ASR-400111</a>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="product-card__footer">
		                                                <div class="product-card__prices">
		                                                    <div class="product-card__price product-card__price--old">$21.00</div>
		                                                    <div class="product-card__price product-card__price--current">$19.00</div>
		                                                </div>
		                                                <a class="product-card__addtocart-icon" aria-label="Add to cart" href="{{route('web.product.shop-detail')}}">
		                                                    <i class="fa fa-arrow-right"></i>
		                                                </a>
		                                            </div>
		                                        </div>
                                            </div>
                                            <div class="products-list__item">
		                                        <div class="product-card">
		                                            <div class="product-card__actions-list">
		                                                <button class="product-card__action product-card__action--quickview" type="button" aria-label="Add to wish list">
		                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16">
		                                                        <path d="M13.9,8.4l-5.4,5.4c-0.3,0.3-0.7,0.3-1,0L2.1,8.4c-1.5-1.5-1.5-3.8,0-5.3C2.8,2.4,3.8,2,4.8,2s1.9,0.4,2.6,1.1L8,3.7
																l0.6-0.6C9.3,2.4,10.3,2,11.3,2c1,0,1.9,0.4,2.6,1.1C15.4,4.6,15.4,6.9,13.9,8.4z" />
		                                                    </svg>
		                                                </button>
		                                            </div>
		                                            <div class="product-card__image">
		                                                <a href="{{route('web.product.shop-detail')}}"><img src="{{asset('web/images/products/1c.jpg')}}" alt=""></a>
		                                            </div>
		                                            <div class="product-card__info">
		                                                <div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> 140-10440-B</div>
		                                                <div class="product-card__name">
		                                                    <div>
		                                                        <a href="{{route('web.product.shop-detail')}}">Brandix Spark Plug Kit ASR-400111</a>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                            <div class="product-card__footer">
		                                                <div class="product-card__prices">
		                                                    <div class="product-card__price product-card__price--old">$21.00</div>
		                                                    <div class="product-card__price product-card__price--current">$19.00</div>
		                                                </div>
		                                                <a class="product-card__addtocart-icon" aria-label="Add to cart" href="{{route('web.product.shop-detail')}}">
		                                                    <i class="fa fa-arrow-right"></i>
		                                                </a>
		                                            </div>
		                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="products-view__pagination">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                <li class="page-item disabled"><a class="page-link page-link--with-arrow" href="#" aria-label="Previous"><span class="page-link__arrow page-link__arrow--left" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="7" height="11"><path d="M6.7,0.3L6.7,0.3c-0.4-0.4-0.9-0.4-1.3,0L0,5.5l5.4,5.2c0.4,0.4,0.9,0.3,1.3,0l0,0c0.4-0.4,0.4-1,0-1.3l-4-3.9l4-3.9C7.1,1.2,7.1,0.6,6.7,0.3z"/></svg></span></a></li>
                                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item active" aria-current="page"><span class="page-link">2 <span class="sr-only">(current)</span></span>
                                                </li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                                <li class="page-item page-item--dots">
                                                    <div class="pagination__dots"></div>
                                                </li>
                                                <li class="page-item"><a class="page-link" href="#">9</a></li>
                                                <li class="page-item"><a class="page-link page-link--with-arrow" href="#" aria-label="Next"><span class="page-link__arrow page-link__arrow--right" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="7" height="11"><path d="M0.3,10.7L0.3,10.7c0.4,0.4,0.9,0.4,1.3,0L7,5.5L1.6,0.3C1.2-0.1,0.7,0,0.3,0.3l0,0c-0.4,0.4-0.4,1,0,1.3l4,3.9l-4,3.9
												C-0.1,9.8-0.1,10.4,0.3,10.7z"/></svg></span></a></li>
                                            </ul>
                                        </nav>
                                        <div class="products-view__pagination-legend">Showing 6 of 98 products</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-space block-space--layout--before-footer"></div>
                </div>
            </div>
        </div>
        <!-- site__body / end -->
	@endsection
	
	@section('script')
	@endsection