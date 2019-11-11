## Utility classes for Laravel >= 5.8 <7.0.0

### Eloquent

Model class to extends for Models

Base Model class offers:
- runtime easy caching 
<br>`MyModel::cacheGet('myKey');`  
`MyModel::cacheSet('myKey', $model);`  
- retrieve and cache 
<br>`MyModel::find_and_remember(1);`
- retrieve and cache as 
<br>`MyModel::find_and_remember_as(1, 'MyKey');`
- retrieve if not available and cache 
<br>`MyModel::find_or_recall(1);`
- custom builder to retrieve and cache
<br> `MyModel::where(...)->get_and_remember_as('MyKey');`

Collection as results of queries on a Model return an instance of `khwadj\Eloquent\Collection` that is indexed by primary key

```
$models = MyModel::all();
// get the model with primary key = 1
$model_one = $models->get(1);
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