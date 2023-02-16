# class-array-helper
Basic abstract class to create object array wrappers. Enables type hinting an array of a particular class instead of a generic array type hint.

## Example usage

```
class UsersArray extends ClassArray
{
    protected function className(): string
    {
        return User::class;
    }
}
```

Type hinting in a code now ensures an array will be received only containing objects of the given class
```
public function store(UsersArray $users) {
    // 
}
```
