@extends('admin.template-index')

@section('header-title')
    Sample of Pages with Tables
@endsection

@section('header-code')
@endsection

@section('main-content')
    <div class="mdc-layout-grid">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                <div class="mdc-card p-0">
                    <h6 class="card-title card-padding pb-0">Basic Table</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-left">Dessert (100g serving)</th>
                                    <th>Calories</th>
                                    <th>Fat (g)</th>
                                    <th>Link</th>
                                    <th>Carbs</th>
                                    <th>Protein (g)</th>
                                    <th>Sodium (mg)</th>
                                    <th>Calcium (%)</th>
                                    <th>Iron (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-left">Frozen yogurt</td>
                                    <td>1.59</td>
                                    <td>6.0</td>
                                    <td>50</td>
                                    <td>4.0</td>
                                    <td>87</td>
                                    <td>20%</td>
                                    <td>4%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Frozen yogurt</td>
                                    <td>1.59</td>
                                    <td>2.5</td>
                                    <td>35</td>
                                    <td>2.0</td>
                                    <td>97</td>
                                    <td>17%</td>
                                    <td>2%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Ice crean sandwich</td>
                                    <td>1.4</td>
                                    <td>4.0</td>
                                    <td>40</td>
                                    <td>8.0</td>
                                    <td>83</td>
                                    <td>14%</td>
                                    <td>7%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Eclair</td>
                                    <td>1.7</td>
                                    <td>3.0</td>
                                    <td>34</td>
                                    <td>6.0</td>
                                    <td>67</td>
                                    <td>17%</td>
                                    <td>3%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Cupcake</td>
                                    <td>2.49</td>
                                    <td>4.0</td>
                                    <td>45</td>
                                    <td>3.05</td>
                                    <td>83</td>
                                    <td>20%</td>
                                    <td>9%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Jellybean</td>
                                    <td>0.78</td>
                                    <td>5.2</td>
                                    <td>35</td>
                                    <td>2.0</td>
                                    <td>27</td>
                                    <td>18%</td>
                                    <td>37%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Gingerbread</td>
                                    <td>1.59</td>
                                    <td>6.0</td>
                                    <td>50</td>
                                    <td>4.0</td>
                                    <td>87</td>
                                    <td>20%</td>
                                    <td>4%</td>
                                    <td>5.7%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Lollipop</td>
                                    <td>1.59</td>
                                    <td>6.0</td>
                                    <td>50</td>
                                    <td>4.0</td>
                                    <td>87</td>
                                    <td>20%</td>
                                    <td>4%</td>
                                    <td>6.5%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Honeycomb</td>
                                    <td>0.45</td>
                                    <td>5.0</td>
                                    <td>45</td>
                                    <td>3.5</td>
                                    <td>45</td>
                                    <td>19%</td>
                                    <td>26%</td>
                                    <td>9%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Donut</td>
                                    <td>0.67</td>
                                    <td>5.0</td>
                                    <td>56</td>
                                    <td>3.34</td>
                                    <td>67</td>
                                    <td>23%</td>
                                    <td>4%</td>
                                    <td>1.8%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Kitkat</td>
                                    <td>0.59</td>
                                    <td>8.34</td>
                                    <td>43</td>
                                    <td>1.97</td>
                                    <td>34</td>
                                    <td>18%</td>
                                    <td>13%</td>
                                    <td>1.5%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                <div class="mdc-card p-0">
                    <h6 class="card-title card-padding pb-0">Hoverable Table</h6>
                    <div class="table-responsive">
                        <table class="table table-hoverable">
                            <thead>
                                <tr>
                                    <th class="text-left">Dessert (100g serving)</th>
                                    <th>Calories</th>
                                    <th>Fat (g)</th>
                                    <th>Link</th>
                                    <th>Carbs</th>
                                    <th>Protein (g)</th>
                                    <th>Sodium (mg)</th>
                                    <th>Calcium (%)</th>
                                    <th>Iron (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-left">Frozen yogurt</td>
                                    <td>1.59</td>
                                    <td>6.0</td>
                                    <td>50</td>
                                    <td>4.0</td>
                                    <td>87</td>
                                    <td>20%</td>
                                    <td>4%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Frozen yogurt</td>
                                    <td>1.59</td>
                                    <td>2.5</td>
                                    <td>35</td>
                                    <td>2.0</td>
                                    <td>97</td>
                                    <td>17%</td>
                                    <td>2%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Ice crean sandwich</td>
                                    <td>1.4</td>
                                    <td>4.0</td>
                                    <td>40</td>
                                    <td>8.0</td>
                                    <td>83</td>
                                    <td>14%</td>
                                    <td>7%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Eclair</td>
                                    <td>1.7</td>
                                    <td>3.0</td>
                                    <td>34</td>
                                    <td>6.0</td>
                                    <td>67</td>
                                    <td>17%</td>
                                    <td>3%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Cupcake</td>
                                    <td>2.49</td>
                                    <td>4.0</td>
                                    <td>45</td>
                                    <td>3.05</td>
                                    <td>83</td>
                                    <td>20%</td>
                                    <td>9%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Jellybean</td>
                                    <td>0.78</td>
                                    <td>5.2</td>
                                    <td>35</td>
                                    <td>2.0</td>
                                    <td>27</td>
                                    <td>18%</td>
                                    <td>37%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Gingerbread</td>
                                    <td>1.59</td>
                                    <td>6.0</td>
                                    <td>50</td>
                                    <td>4.0</td>
                                    <td>87</td>
                                    <td>20%</td>
                                    <td>4%</td>
                                    <td>5.7%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Lollipop</td>
                                    <td>1.59</td>
                                    <td>6.0</td>
                                    <td>50</td>
                                    <td>4.0</td>
                                    <td>87</td>
                                    <td>20%</td>
                                    <td>4%</td>
                                    <td>6.5%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Honeycomb</td>
                                    <td>0.45</td>
                                    <td>5.0</td>
                                    <td>45</td>
                                    <td>3.5</td>
                                    <td>45</td>
                                    <td>19%</td>
                                    <td>26%</td>
                                    <td>9%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Donut</td>
                                    <td>0.67</td>
                                    <td>5.0</td>
                                    <td>56</td>
                                    <td>3.34</td>
                                    <td>67</td>
                                    <td>23%</td>
                                    <td>4%</td>
                                    <td>1.8%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Kitkat</td>
                                    <td>0.59</td>
                                    <td>8.34</td>
                                    <td>43</td>
                                    <td>1.97</td>
                                    <td>34</td>
                                    <td>18%</td>
                                    <td>13%</td>
                                    <td>1.5%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
                <div class="mdc-card p-0">
                    <h6 class="card-title card-padding pb-0">Striped Table</h6>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-left">Dessert (100g serving)</th>
                                    <th>Calories</th>
                                    <th>Fat (g)</th>
                                    <th>Link</th>
                                    <th>Carbs</th>
                                    <th>Protein (g)</th>
                                    <th>Sodium (mg)</th>
                                    <th>Calcium (%)</th>
                                    <th>Iron (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-left">Frozen yogurt</td>
                                    <td>1.59</td>
                                    <td>6.0</td>
                                    <td>50</td>
                                    <td>4.0</td>
                                    <td>87</td>
                                    <td>20%</td>
                                    <td>4%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Frozen yogurt</td>
                                    <td>1.59</td>
                                    <td>2.5</td>
                                    <td>35</td>
                                    <td>2.0</td>
                                    <td>97</td>
                                    <td>17%</td>
                                    <td>2%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Ice crean sandwich</td>
                                    <td>1.4</td>
                                    <td>4.0</td>
                                    <td>40</td>
                                    <td>8.0</td>
                                    <td>83</td>
                                    <td>14%</td>
                                    <td>7%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Eclair</td>
                                    <td>1.7</td>
                                    <td>3.0</td>
                                    <td>34</td>
                                    <td>6.0</td>
                                    <td>67</td>
                                    <td>17%</td>
                                    <td>3%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Cupcake</td>
                                    <td>2.49</td>
                                    <td>4.0</td>
                                    <td>45</td>
                                    <td>3.05</td>
                                    <td>83</td>
                                    <td>20%</td>
                                    <td>9%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Jellybean</td>
                                    <td>0.78</td>
                                    <td>5.2</td>
                                    <td>35</td>
                                    <td>2.0</td>
                                    <td>27</td>
                                    <td>18%</td>
                                    <td>37%</td>
                                    <td>6%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Gingerbread</td>
                                    <td>1.59</td>
                                    <td>6.0</td>
                                    <td>50</td>
                                    <td>4.0</td>
                                    <td>87</td>
                                    <td>20%</td>
                                    <td>4%</td>
                                    <td>5.7%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Lollipop</td>
                                    <td>1.59</td>
                                    <td>6.0</td>
                                    <td>50</td>
                                    <td>4.0</td>
                                    <td>87</td>
                                    <td>20%</td>
                                    <td>4%</td>
                                    <td>6.5%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Honeycomb</td>
                                    <td>0.45</td>
                                    <td>5.0</td>
                                    <td>45</td>
                                    <td>3.5</td>
                                    <td>45</td>
                                    <td>19%</td>
                                    <td>26%</td>
                                    <td>9%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Donut</td>
                                    <td>0.67</td>
                                    <td>5.0</td>
                                    <td>56</td>
                                    <td>3.34</td>
                                    <td>67</td>
                                    <td>23%</td>
                                    <td>4%</td>
                                    <td>1.8%</td>
                                </tr>
                                <tr>
                                    <td class="text-left">Kitkat</td>
                                    <td>0.59</td>
                                    <td>8.34</td>
                                    <td>43</td>
                                    <td>1.97</td>
                                    <td>34</td>
                                    <td>18%</td>
                                    <td>13%</td>
                                    <td>1.5%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-code')
@endsection
