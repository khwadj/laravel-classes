## Utility classes for Laravel >= 5.8 
### Highest Laravel compatibily tested as of this readme : 7.9.2

Version 0.2   max tested compatibility : Laravel 5.8 (hard limitation < 6.1.0 per composer.json)

Version 0.2.1 max tested compatibility : Laravel 5.8 (hard limitation < 7.0.0 per composer.json)

Version 0.2.2 max tested compatibility : Laravel 5.8 (hard limitation < 7.0.0 per composer.json)

Version 0.3   max tested compatibility : Laravel 6.2 (hard limitation < 7.0.0 per composer.json)

Version 0.4   max tested compatibility : Laravel 7.9.2



Recommended version is 0.4.0 for any version of Laravel ( >= 5.8 )
Minimum version usable is 0.3.0. Versions before that are not reliable and should be avoided.

### Eloquent

Model class to extends for Models

Base Model class offers:
- runtime easy caching 
<br>`$model = MyModel::cacheGet('myCacheKey');`  
`MyModel::cacheSet('myCacheKey', $model);`  
- retrieve and cache 
<br>`$model = MyModel::find_and_remember(1);`
- retrieve and cache as 
<br>`MyModel::find_and_remember_as(1, 'myCacheKey');`
- retrieve if not available and cache 
<br>`$model = MyModel::find_or_recall(1);`
- custom builder to retrieve and cache
<br> `MyModel::where(...)->get_and_remember_as('All_models_with_that_property');`
<br> `MyModel::where(...)->first_and_remember_as('One_model_with_that_property');`
<br> `MyModel::where(...)->first_and_remember();`

<br>Collection as results of queries on a Model return an instance of `khwadj\Eloquent\Collection` that is indexed by primary key

```
$models = MyModel::all();
// get the model with primary key = 1
$model_one = $models->get(1);

// check and retrieve from relationships
if ( $model_one->relation_many->has(555) ) {
    $related_model = $model_one->relation_many->get(555);
}
```

since 0.3.0 : retrieve from eager-loaded relationships
```
$models    = MyModel::with('relationship_many')->get();
$model_one = $models->get(1);
// check and retrieve from eager-loaded relationships
if ( $model_one->relation_many->has(555) ) {
    $related_model = $model_one->relation_many->get(555);
}
```

Note: PK is determined by `$model->getKey()` which will be empty if your model doesn't use an auto-incremented PK. You can update this function to return any unique stringable value representing your model.

### View Service Provider

Simply redeclares gatherData() function to upgrade performances.
In return, Renderable arguments cannot be passed to a view.

In config > app.php

```
'providers' => [
        ...
        // Illuminate\View\ViewServiceProvider::class,
        \Khwadj\View\ViewServiceProvider::class,
        ...
```