# ArrayList - PHP ArrayList like in Java [ArrayList](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html)

[![Build Status](https://travis-ci.org/makeey/ArrayList.svg?branch=master)](https://travis-ci.org/makeey/ArrayList)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
![Coverage Status](https://coveralls.io/repos/github/makeey/ArrayList/badge.svg?branch=dev)

## Features

ArrayList can validate:

- Scalar types: `string`, `integer`, etc.:

```php
(new \ArrayList\ArrayList('string')); // => Construct  ArrayList with empty values type 'string'
(new \ArrayList\ArrayList('string', ['1', '2', '3'])); // => to construct object
(new \ArrayList\ArrayList('string', [1, 2, 3])); // => to be thow exception
(new \ArrayList\ArrayList('string', (new \ArrrayList\ArrayList('string', ['foo', 'bar'])))); // => Construct  ArrayList with values from other ArrayList
```

ArrayList have methods with [overloaded](https://en.wikipedia.org/wiki/Function_overloading):
- method [add($element)](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html#add(E)). Appends the specified element to the end of this list.
```php
(new \ArrayList\ArrayList('string', ['1', '2', '3']))->add(4); // => wrong type. Throw expection
(new \ArrayList\ArrayList('string', ['1', '2', '3']))->add('4'); // => append element to end of list
```

- method [add(int $index, $element)](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html#add(int,%20E)) Inserts the specified element at the specified position in this list.
```php
(new \ArrayList\ArrayList('string', ['1', '2', '3']))->add(2,'4'); // => return true
(new \ArrayList\ArrayList('string', ['1', '2', '3']))->add(2, 4); //  throw exepction
```

- method [addAll(ArrayList\Collection $element)](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html#addAll(java.util.Collection))  Appends all of the elements in the specified collection to the end of this list, in the order that they are returned by the specified collection's Iterator.
```php
(new \ArrayList\ArrayList('string', ['1', '2', '3']))->addAll((new \ArrayList\ArrayList('string', ['1', '2', '3'])); // => return true
(new \ArrayList\ArrayList('string', ['1', '2', '3']))->addAll((new \ArrayList\ArrayList('integer', [1, 2, 3])); // => throw exception
```

- method [addAll(int $index, ArrayList\Collection $element)](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html#addAll(int,%20java.util.Collection))  Inserts all of the elements in the specified collection into this list, starting at the specified position.

```php
(new \ArrayList\ArrayList('string', ['1', '2', '3']))->addAll(2, (new \ArrayList\ArrayList('string', ['1', '2', '3'])); // => return true
(new \ArrayList\ArrayList('string', ['1', '2', '3']))->addAll(2, (new \ArrayList\ArrayList('integer', [1, 2, 3])); // => throw exception
```

- method [isEmpty()](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html#isEmpty())  Returns true if this list contains no elements. 
```php
(new \ArrayList\ArrayList('string'))->isEmtpy(); // return true
(new \ArrayList\ArrayList('string', ['1', '2', '3']))->isEmtpy(); //to be false
```

- method [get(int $index)](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html#get(int)) Returns the element at the specified position in this list.
```php
(new \ArrayList\ArrayList('string', ['string1']))->get(1); //  throw OutOfBoundsException
(new \ArrayList\ArrayList('string', ['string1']))->get(0); // return 'string1'
```

- method [set(int $index)](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html#set(int,%20E)) Replaces the element at the specified position in this list with the specified element.
```php
(new \ArrayList\ArrayList('string', ['string1']))->set(1, 'string2'); //  throw OutOfBoundsException
(new \ArrayList\ArrayList('string', ['string1']))->set(0, 'string2'); // set new value
(new \ArrayList\ArrayList('string', ['string1']))->set(0, 2); // throw exception
```

- method [size()](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html#size()) Returns the number of elements in this list.
```php
(new \ArrayList\ArrayList('string', ['string1']))->size(); //  return size ArrayList
```

- method [contains($element)](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html#contains(java.lang.Object)) Returns true if this list contains the specified element.
```php
(new \ArrayList\ArrayList('string', ['string1']))->constains('string1'); //  return true
```
- method [containsAll(ArrayList\Collection $element)](https://docs.oracle.com/javase/7/docs/api/java/util/AbstractCollection.html#containsAll(java.util.Collection)) Returns true if this collection contains all of the elements in the specified collection.
```php
(new \ArrayList\ArrayList('string', ['string1']))->constains((new \ArrayList\ArrayList('string', ['string1'])); //  return true
```

- method [indexOf($element)](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html#indexOf(java.lang.Object)) Returns the index of the first occurrence of the specified element in this list, or -1 if this list does not contain the element.
```php
(new \ArrayList\ArrayList('string',['string1','strign2']))->indexOf('string1'); //  return 0
```

- method [lastIndexOf($element)](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html#lastIndexOf(java.lang.Object)) Returns the index of the last occurrence of the specified element in this list, or -1 if this list does not contain the element.
```php
(new \ArrayList\ArrayList('string', ['string1', 'strign1']))->lastIndexOf('string1'); //  return 1
```

- method [toArray()](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html#toArray()) Returns an array containing all of the elements in this list in proper sequence (from first to last element).
```php
(new \ArrayList\ArrayList('string', ['string1', 'strign1']))->toArray(); //  return ['string1','strign1']
```

- method [clear()](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html#clear()) Removes all of the elements from this list.
```php
(new \ArrayList\ArrayList('string', ['string1', 'strign1']))->clear(); //  clear values 
```

- method [remove($index)](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html#remove(int))  Removes the element at the specified position in this list.
```php
(new \ArrayList\ArrayList('string',['string1','strign1']))->remove(0); //  return 'string1' 
```

- method [remove($element)](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html#remove(java.lang.Object))  Removes the first occurrence of the specified element from this list, if it is present.
```php
(new \ArrayList\ArrayList('string', ['string1', 'strign1']))->remove('string1'); //  return 'string1' 
```

- method [removeAll(ArrayList\Collection $collection)](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html#removeAll(java.util.Collection)) Removes from this list all of its elements that are contained in the specified collection.
```php
(new \ArrayList\ArrayList('string', ['string1', 'strign1']))->removeAll((new ArrayList\ArrayList('string', ['string1'])); //  return true
```

- method [removeRange(int $from, int to)](https://docs.oracle.com/javase/7/docs/api/java/util/ArrayList.html#removeRange(int,%20int)) Removes from this list all of its elements that are contained in the specified collection.
```php
(new \ArrayList\ArrayList('string', ['string1', 'strign1', 'strign1']))->removeRange(0, 1); //  return true
```
