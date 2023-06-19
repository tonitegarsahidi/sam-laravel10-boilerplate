@extends('admin.template-index')

@section('header-title')
    Sample of Pages with Forms
@endsection

@section('header-code')
@endsection

@section('main-content')
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--span-6-desktop stretch-card">
                <div class="mdc-card">
                    <h6 class="card-title">Switch</h6>
                    <div class="template-demo">
                        <div class="mdc-switch" data-mdc-auto-init="MDCSwitch">
                            <div class="mdc-switch__track"></div>
                            <div class="mdc-switch__thumb-underlay">
                                <div class="mdc-switch__thumb">
                                    <input type="checkbox" id="basic-switch" class="mdc-switch__native-control"
                                        role="switch">
                                </div>
                            </div>
                        </div>
                        <div class="mdc-switch mdc-switch--checked" data-mdc-auto-init="MDCSwitch">
                            <div class="mdc-switch__track"></div>
                            <div class="mdc-switch__thumb-underlay">
                                <div class="mdc-switch__thumb">
                                    <input type="checkbox" id="basic-switch" class="mdc-switch__native-control"
                                        role="switch" checked>
                                </div>
                            </div>
                        </div>
                        <div class="mdc-switch mdc-switch--disabled" data-mdc-auto-init="MDCSwitch">
                            <div class="mdc-switch__track"></div>
                            <div class="mdc-switch__thumb-underlay">
                                <div class="mdc-switch__thumb">
                                    <input type="checkbox" id="basic-switch" class="mdc-switch__native-control"
                                        role="switch">
                                </div>
                            </div>
                        </div>
                        <div class="mdc-switch mdc-switch--secondary" data-mdc-auto-init="MDCSwitch">
                            <div class="mdc-switch__track"></div>
                            <div class="mdc-switch__thumb-underlay">
                                <div class="mdc-switch__thumb">
                                    <input type="checkbox" id="basic-switch" class="mdc-switch__native-control"
                                        role="switch" checked>
                                </div>
                            </div>
                        </div>
                        <div class="mdc-switch mdc-switch--success" data-mdc-auto-init="MDCSwitch">
                            <div class="mdc-switch__track"></div>
                            <div class="mdc-switch__thumb-underlay">
                                <div class="mdc-switch__thumb">
                                    <input type="checkbox" id="basic-switch" class="mdc-switch__native-control"
                                        role="switch" checked>
                                </div>
                            </div>
                        </div>
                        <div class="mdc-switch mdc-switch--info" data-mdc-auto-init="MDCSwitch">
                            <div class="mdc-switch__track"></div>
                            <div class="mdc-switch__thumb-underlay">
                                <div class="mdc-switch__thumb">
                                    <input type="checkbox" id="basic-switch" class="mdc-switch__native-control"
                                        role="switch" checked>
                                </div>
                            </div>
                        </div>
                        <div class="mdc-switch mdc-switch--warning" data-mdc-auto-init="MDCSwitch">
                            <div class="mdc-switch__track"></div>
                            <div class="mdc-switch__thumb-underlay">
                                <div class="mdc-switch__thumb">
                                    <input type="checkbox" id="basic-switch" class="mdc-switch__native-control"
                                        role="switch" checked>
                                </div>
                            </div>
                        </div>
                        <div class="mdc-switch mdc-switch--light" data-mdc-auto-init="MDCSwitch">
                            <div class="mdc-switch__track"></div>
                            <div class="mdc-switch__thumb-underlay">
                                <div class="mdc-switch__thumb">
                                    <input type="checkbox" id="basic-switch" class="mdc-switch__native-control"
                                        role="switch" checked>
                                </div>
                            </div>
                        </div>
                        <div class="mdc-switch mdc-switch--dark" data-mdc-auto-init="MDCSwitch">
                            <div class="mdc-switch__track"></div>
                            <div class="mdc-switch__thumb-underlay">
                                <div class="mdc-switch__thumb">
                                    <input type="checkbox" id="basic-switch" class="mdc-switch__native-control"
                                        role="switch" checked>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mdc-layout-grid__cell--span-4 mdc-layout-grid__cell--span-6-desktop stretch-card">
                <div class="mdc-card">
                    <h6 class="card-title">Select Menu</h6>
                    <div class="template-demo">
                        <div class="mdc-select demo-width-class" data-mdc-auto-init="MDCSelect">
                            <input type="hidden" name="enhanced-select">
                            <i class="mdc-select__dropdown-icon"></i>
                            <div class="mdc-select__selected-text"></div>
                            <div class="mdc-select__menu mdc-menu-surface demo-width-class">
                                <ul class="mdc-list">
                                    <li class="mdc-list-item mdc-list-item--selected" data-value="" aria-selected="true">
                                    </li>
                                    <li class="mdc-list-item" data-value="grains">
                                        Bread, Cereal, Rice, and Pasta
                                    </li>
                                    <li class="mdc-list-item" data-value="vegetables">
                                        Vegetables
                                    </li>
                                    <li class="mdc-list-item" data-value="fruit">
                                        Fruit
                                    </li>
                                </ul>
                            </div>
                            <span class="mdc-floating-label">Pick a Food Group</span>
                            <div class="mdc-line-ripple"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-card">
                    <h6 class="card-title">Text Field</h6>
                    <div class="template-demo">
                        <div class="mdc-layout-grid__inner">
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                <div class="mdc-text-field">
                                    <input class="mdc-text-field__input" id="text-field-hero-input">
                                    <div class="mdc-line-ripple"></div>
                                    <label for="text-field-hero-input" class="mdc-floating-label">Name</label>
                                </div>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                <div class="mdc-text-field mdc-text-field--outlined">
                                    <input class="mdc-text-field__input" id="text-field-hero-input">
                                    <div class="mdc-notched-outline">
                                        <div class="mdc-notched-outline__leading"></div>
                                        <div class="mdc-notched-outline__notch">
                                            <label for="text-field-hero-input" class="mdc-floating-label">Name</label>
                                        </div>
                                        <div class="mdc-notched-outline__trailing"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-leading-icon">
                                    <i class="material-icons mdc-text-field__icon">favorite</i>
                                    <input class="mdc-text-field__input" id="text-field-hero-input">
                                    <div class="mdc-notched-outline">
                                        <div class="mdc-notched-outline__leading"></div>
                                        <div class="mdc-notched-outline__notch">
                                            <label for="text-field-hero-input" class="mdc-floating-label">Name</label>
                                        </div>
                                        <div class="mdc-notched-outline__trailing"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-6-desktop">
                                <div class="mdc-text-field mdc-text-field--outlined mdc-text-field--with-trailing-icon">
                                    <i class="material-icons mdc-text-field__icon">visibility</i>
                                    <input class="mdc-text-field__input" id="text-field-hero-input">
                                    <div class="mdc-notched-outline">
                                        <div class="mdc-notched-outline__leading"></div>
                                        <div class="mdc-notched-outline__notch">
                                            <label for="text-field-hero-input" class="mdc-floating-label">Name</label>
                                        </div>
                                        <div class="mdc-notched-outline__trailing"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell--span-12">
                <div class="mdc-card">
                    <h6 class="card-title">Checkbox</h6>
                    <div class="template-demo">
                        <div class="mdc-form-field">
                            <div class="mdc-checkbox">
                                <input type="checkbox" class="mdc-checkbox__native-control" id="checkbox-1" />
                                <div class="mdc-checkbox__background">
                                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                        <path class="mdc-checkbox__checkmark-path" fill="none"
                                            d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                    </svg>
                                    <div class="mdc-checkbox__mixedmark"></div>
                                </div>
                            </div>
                            <label for="checkbox-1">Default</label>
                        </div>
                        <div class="mdc-form-field">
                            <div class="mdc-checkbox mdc-checkbox--disabled">
                                <input type="checkbox" id="basic-disabled-checkbox" class="mdc-checkbox__native-control"
                                    disabled />
                                <div class="mdc-checkbox__background">
                                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                        <path class="mdc-checkbox__checkmark-path" fill="none"
                                            d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                    </svg>
                                    <div class="mdc-checkbox__mixedmark"></div>
                                </div>
                            </div>
                            <label for="basic-disabled-checkbox" id="basic-disabled-checkbox-label">Disabled</label>
                        </div>
                        <div class="mdc-form-field">
                            <div class="mdc-checkbox">
                                <input type="checkbox" id="basic-disabled-checkbox" class="mdc-checkbox__native-control"
                                    checked />
                                <div class="mdc-checkbox__background">
                                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                        <path class="mdc-checkbox__checkmark-path" fill="none"
                                            d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                    </svg>
                                    <div class="mdc-checkbox__mixedmark"></div>
                                </div>
                            </div>
                            <label for="basic-disabled-checkbox" id="basic-disabled-checkbox-label">Primary
                                Checked</label>
                        </div>
                        <div class="mdc-form-field">
                            <div class="mdc-checkbox mdc-checkbox--secondary">
                                <input type="checkbox" id="basic-disabled-checkbox" class="mdc-checkbox__native-control"
                                    checked />
                                <div class="mdc-checkbox__background">
                                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                        <path class="mdc-checkbox__checkmark-path" fill="none"
                                            d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                    </svg>
                                    <div class="mdc-checkbox__mixedmark"></div>
                                </div>
                            </div>
                            <label for="basic-disabled-checkbox" id="basic-disabled-checkbox-label">Secondary</label>
                        </div>
                        <div class="mdc-form-field">
                            <div class="mdc-checkbox mdc-checkbox--success">
                                <input type="checkbox" id="basic-disabled-checkbox" class="mdc-checkbox__native-control"
                                    checked />
                                <div class="mdc-checkbox__background">
                                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                        <path class="mdc-checkbox__checkmark-path" fill="none"
                                            d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                    </svg>
                                    <div class="mdc-checkbox__mixedmark"></div>
                                </div>
                            </div>
                            <label for="basic-disabled-checkbox" id="basic-disabled-checkbox-label">Success</label>
                        </div>
                        <div class="mdc-form-field">
                            <div class="mdc-checkbox mdc-checkbox--info">
                                <input type="checkbox" id="basic-disabled-checkbox" class="mdc-checkbox__native-control"
                                    checked />
                                <div class="mdc-checkbox__background">
                                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                        <path class="mdc-checkbox__checkmark-path" fill="none"
                                            d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                    </svg>
                                    <div class="mdc-checkbox__mixedmark"></div>
                                </div>
                            </div>
                            <label for="basic-disabled-checkbox" id="basic-disabled-checkbox-label">Info</label>
                        </div>
                        <div class="mdc-form-field">
                            <div class="mdc-checkbox mdc-checkbox--warning">
                                <input type="checkbox" id="basic-disabled-checkbox" class="mdc-checkbox__native-control"
                                    checked />
                                <div class="mdc-checkbox__background">
                                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                        <path class="mdc-checkbox__checkmark-path" fill="none"
                                            d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                    </svg>
                                    <div class="mdc-checkbox__mixedmark"></div>
                                </div>
                            </div>
                            <label for="basic-disabled-checkbox" id="basic-disabled-checkbox-label">Warning</label>
                        </div>
                        <div class="mdc-form-field">
                            <div class="mdc-checkbox mdc-checkbox--light">
                                <input type="checkbox" id="basic-disabled-checkbox" class="mdc-checkbox__native-control"
                                    checked />
                                <div class="mdc-checkbox__background">
                                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                        <path class="mdc-checkbox__checkmark-path" fill="none"
                                            d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                    </svg>
                                    <div class="mdc-checkbox__mixedmark"></div>
                                </div>
                            </div>
                            <label for="basic-disabled-checkbox" id="basic-disabled-checkbox-label">Light</label>
                        </div>
                        <div class="mdc-form-field">
                            <div class="mdc-checkbox mdc-checkbox--dark">
                                <input type="checkbox" id="basic-disabled-checkbox" class="mdc-checkbox__native-control"
                                    checked />
                                <div class="mdc-checkbox__background">
                                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                        <path class="mdc-checkbox__checkmark-path" fill="none"
                                            d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                    </svg>
                                    <div class="mdc-checkbox__mixedmark"></div>
                                </div>
                            </div>
                            <label for="basic-disabled-checkbox" id="basic-disabled-checkbox-label">Dark</label>
                        </div>
                        <div class="mdc-form-field">
                            <div class="mdc-checkbox mdc-checkbox--custom">
                                <input type="checkbox" id="basic-custom-checkbox" class="mdc-checkbox__native-control" />
                                <div class="mdc-checkbox__background">
                                    <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                                        <path class="mdc-checkbox__checkmark__path" dropzone=""fill="none"
                                            stroke="white" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                                    </svg>
                                    <div class="mdc-checkbox__mixedmark"></div>
                                </div>
                            </div>
                            <label for="basic-custom-checkbox">Custom colored</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-code')
@endsection
