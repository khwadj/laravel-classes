## Utility classes for Laravel >= 5.8 
### Highest Laravel compatibily tested as of this readme : 7.0

Tested with Laravel 5.8 up to version 0.2, then tested with Laravel 6.X

Recommended version is 0.3.0 for any version of Laravel ( >= 5.8 )

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