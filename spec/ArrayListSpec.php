<?php

namespace ArrayList\Spec;


use ArrayList\ArrayList;
use ArrayList\ClassCastException;
use ArrayList\Collection;
use ArrayList\IndexOutOfBoundsException;
use Sevavietl\OverloadedFunction\UnknownSignatureException;

describe('ArrayList', function () {

    given('arrayList', function () {
        return new ArrayList('string');
    });
    describe('instance of Collection test', function () {
        it('return "Collection" instance', function () {
            expect($this->arrayList)->toBeAnInstanceOf(Collection::class);
        });
    });

    describe('Construct with array value', function () {
        it('Construct with array value', function () {
            $arrayListWithArray = new ArrayList('string', ['string1', 'string2', 'string3']);
            expect($arrayListWithArray)->toBeAnInstanceOf(ArrayList::class);
            expect($arrayListWithArray->toArray())->toBeA('array')->toBe(['string1', 'string2', 'string3']);
        });
    });
    describe('Construct with Collection Value', function () {
        it('Construct with Collection Value', function () {
            $arrayListWithArray = new ArrayList('string', ['string1', 'string2', 'string3']);
            $newArrayListWithCollectionInterface = new ArrayList('string', $arrayListWithArray);
            expect($newArrayListWithCollectionInterface)->toBeAnInstanceOf(ArrayList::class);
            expect($newArrayListWithCollectionInterface->toArray())->toBeA('array')->toBe(['string1', 'string2', 'string3']);
        });
    });

    describe('Is empty must be true', function () {
        it('is empty === true', function () {
            expect($this->arrayList->isEmpty())->toEqual(true);
        });
    });

    describe('It is add with wrong type arguments', function () {
        it('it is must be a exception "UnknownSignatureException" ', function () {
            $closure = function () {
                $this->arrayList->add(2);
            };
            expect($closure)->toThrow(new UnknownSignatureException());
        });
    });

    describe('Appends the specified element to the end of this list.', function () {
        it('it is must be a return a true', function () {
            expect($this->arrayList->add('element1'))->toBe(true);
        });
        it('is empty === false', function () {
            $this->arrayList->add('string2');
            expect($this->arrayList->isEmpty())->toEqual(false);
        });
    });

    describe('It is add with index and correct type', function () {

        $this->arrayList->add('string1');
        $this->arrayList->add('string2');
        $this->arrayList->add('string3');
        $this->arrayList->add(1, 'string_from_add');

        it('is empty === false', function () {
            expect($this->arrayList->isEmpty())->toEqual(false);
        });
        it('it must be true', function () {
            expect($this->arrayList->get(1))->toBe('string_from_add');
            expect($this->arrayList->get(2))->toBe('string2');
        });

    });



    describe('It is get elements by index', function () {

        $this->arrayList->add(2, 'string2');

        it('get index 0 must be have value "string2"', function () {
            expect($this->arrayList->get(0))->toEqual('string2');
        });

        it('Must throw exception "IndexOutOfBoundsException"', function () {
            $closure = function () {
                $this->arrayList->get(3);
            };
            expect($closure)->toThrow(new IndexOutOfBoundsException());
        });
    });

    describe('Replaces the element at the specified position in this list with the specified element.', function () {

        it('Must throw exception "IndexOutOfBoundsException"', function () {
            $closure = function () {
                $this->arrayList->set(2, 'string2');
            };
            expect($closure)->toThrow(new IndexOutOfBoundsException());
        });

        it('Must throw exception InvalidArgumentException', function () {
            $closure = function () {
                $this->arrayList->add(2, 'string1');
                $this->arrayList->set(0, 1);
            };
            expect($closure)->toThrow(new \InvalidArgumentException());
        });


        it('It is must be replace element', function () {
            $this->arrayList->add('string1');
            $this->arrayList->set(0, 'string2');
            expect($this->arrayList->get(0))->toEqual('string2');
        });

    });

    describe('Returns the number of elements in this list.', function () {

        it('Must be 0', function () {
            expect($this->arrayList->size())->toEqual(0);
        });

        it('Must be 2', function () {
            $this->arrayList->add('string1');
            $this->arrayList->add('string2');
            expect($this->arrayList->size())->toEqual(2);
        });

    });

    describe('Returns true if this list contains the specified element. More formally, returns true if and only if this list contains at least one element e such that (o==null ? e==null : o.equals(e)).', function () {
        it('Must be return false', function () {
            expect($this->arrayList->contains('string1'))->toEqual(false);
        });
        it('Must be return true', function () {
            $this->arrayList->add('string1');
            expect($this->arrayList->contains('string1'))->toEqual(true);
        });
    });

    describe('indexOf Returns the index of the first occurrence of the specified element in this list, or -1 if this list does not contain the element. More formally, returns the lowest index i such that (o==null ? get(i)==null : o.equals(get(i))), or -1 if there is no such index.',
        function () {
            it('Must be -1', function () {
                expect($this->arrayList->indexOf('string1'))->toEqual(-1);
            });
            it('Must be 0', function () {
                $this->arrayList->add('string1');
                expect($this->arrayList->indexOf('string1'))->toEqual(0);
            });
            it('Must be 0 too', function () {
                $this->arrayList->add('string1');
                $this->arrayList->add('string1');
                expect($this->arrayList->indexOf('string1'))->toEqual(0);
            });
        }
    );

    describe('lastIndexOf Returns the index of the first occurrence of the specified element in this list, or -1 if this list does not contain the element. More formally, returns the lowest index i such that (o==null ? get(i)==null : o.equals(get(i))), or -1 if there is no such index.',
        function () {
            it('Must be -1', function () {
                expect($this->arrayList->lastIndexOf('string1'))->toEqual(-1);
            });
            it('Must be 0', function () {
                $this->arrayList->add('string1');
                expect($this->arrayList->lastIndexOf('string1'))->toEqual(0);
            });
            it('Must be 1', function () {
                $this->arrayList->add('string1');
                $this->arrayList->add('string1');
                expect($this->arrayList->lastIndexOf('string1'))->toEqual(1);
            });
        }
    );

    describe('clear Removes all of the elements from this list. The list will be empty after this call returns.',
        function () {

            it('It is call method clear', function () {
                $this->arrayList->add('string1');
                $this->arrayList->add('string1');
                expect($this->arrayList->isEmpty())->toEqual(false);
                $this->arrayList->clear();
                expect($this->arrayList->isEmpty())->toEqual(true);
            });
        }
    );

    describe('addAll Appends all of the elements in the 
    specified collection to the end of this list, in the order that they are returned by the specified collection\'s Iterator. The behavior of this operation is undefined if the specified collection is modified while the operation is in progress. (This implies that the 
    behavior of this call is undefined if the specified collection is this list, and this list is nonempty.)',
        function () {

            it('It is  add collection ', function () {
                $this->arrayList->add('string1');
                $tmp_array_list = new ArrayList('string');
                $tmp_array_list->add('string2');
                $this->arrayList->addAll($tmp_array_list);
                expect($this->arrayList->isEmpty())->toEqual(false);
                expect($this->arrayList->get(0))->toEqual('string1');
                expect($this->arrayList->get(1))->toEqual('string2');
            });

            it('It is  add collection by index', function () {
                $this->arrayList->add('string1');
                $this->arrayList->add('string2');
                $this->arrayList->add('string3');
                $tmp_array_list = new ArrayList('string',['string']);
                $this->arrayList->addAll(1,$tmp_array_list);
                expect($this->arrayList->isEmpty())->toEqual(false);
                expect($this->arrayList->get(0))->toEqual('string1');
                expect($this->arrayList->get(1))->toEqual('string');
                expect($this->arrayList->get(2))->toEqual('string2');
            });
        }
    );

    describe('contains All Returns true if this collection contains all of the elements in the specified collection.
This implementation iterates over the specified collection, checking each element returned by the iterator in turn to see if it\'s contained in this collection. 
If all elements are so contained true is returned, otherwise false.',
        function () {

            it('containsAll test', function () {
                $this->arrayList->add('string1');
                $this->arrayList->add('string2');
                $this->arrayList->add('string3');

                $containsArrayList = new ArrayList('string');
                $containsArrayList->add('string2');
                $containsArrayList->add('string3');

                expect($this->arrayList->containsAll($containsArrayList))->toBe(true);
            });
            it('containsAll test false', function () {
                $this->arrayList->add('string1');
                $this->arrayList->add('string2');
                $this->arrayList->add('string3');
                $containsArrayList = new ArrayList('string');
                $containsArrayList->add('string2');
                $containsArrayList->add('string5');
                expect($this->arrayList->containsAll($containsArrayList))->toBe(false);
            });

            it('containsAll test with empty array', function () {
                $this->arrayList->add('string1');
                $this->arrayList->add('string2');
                $this->arrayList->add('string3');

                $closure = function () {
                    $containsArrayList = new ArrayList('string');
                    $this->arrayList->containsAll($containsArrayList);
                };
                expect($closure)->toThrow(new \InvalidArgumentException());
            });
            it('containsAll test with collection wrong type', function () {
                $this->arrayList->add('string1');
                $this->arrayList->add('string2');
                $this->arrayList->add('string3');

                $closure = function () {
                    $containsArrayList = new ArrayList('integer');
                    $containsArrayList->add(2);
                    $this->arrayList->containsAll($containsArrayList);
                };
                expect($closure)->toThrow(new ClassCastException());
            });
        }
    );
    // end indexOf

    // to array
    describe('to array',
        function () {

            it('to array test', function () {
                $this->arrayList->add('string1');
                $this->arrayList->add('string2');
                $this->arrayList->add('string3');
                expect($this->arrayList->toArray())->toBeA('array')->toBe(['string1', 'string2', 'string3']);
            });
        }
    );
    // end to array

    // to remove by index
    describe('remove element by index and object',
        function () {

            it('to remove test', function () {
                $this->arrayList->add('string1');
                $this->arrayList->add('string2');
                $this->arrayList->add('string3');
                expect($this->arrayList->toArray())->toBeA('array')->toBe(['string1', 'string2', 'string3']);
                $this->arrayList->remove(0);
                expect($this->arrayList->toArray())->toBeA('array')->toBe(['string2', 'string3']);
                expect($this->arrayList->get(0))->toBe('string2');
            });
            it('to remove test object', function () {
                $this->arrayList->add('string1');
                $this->arrayList->add('string2');
                $this->arrayList->add('string3');
                expect($this->arrayList->toArray())->toBeA('array')->toBe(['string1', 'string2', 'string3']);
                $this->arrayList->remove('string1');
                expect($this->arrayList->toArray())->toBeA('array')->toBe(['string2', 'string3']);
                expect($this->arrayList->get(0))->toBe('string2');
                expect($this->arrayList->size())->toBe(2);
            });
        }
    );

    describe('remove elements in collections',
        function () {

            it('to remove collection', function () {
                $this->arrayList->add('string1');
                $this->arrayList->add('string2');
                $this->arrayList->add('string3');
                $removeArrayList = new ArrayList('string',['string1','string2']);

                expect($this->arrayList->toArray())->toBeA('array')->toBe(['string1', 'string2', 'string3']);
                $this->arrayList->removeAll($removeArrayList);
                expect($this->arrayList->toArray())->toBeA('array')->toBe(['string3']);
                expect($this->arrayList->get(0))->toBe('string3');
                expect($this->arrayList->size())->toBe(1);

            });
            it('to remove collection with wrong type', function () {
                $this->arrayList->add('1');
                $this->arrayList->add('2');
                $this->arrayList->add('3');
                expect($this->arrayList->toArray())->toBeA('array')->toBe(['1', '2', '3']);
                $closure = function(){
                    $removeArrayList = new ArrayList('integer',[1,2]);
                    $this->arrayList->removeAll($removeArrayList);
                };
                expect($closure)->toThrow(new ClassCastException());


            });
        }
    );


    describe('remove range from collection',
        function () {

            it('to remove collection', function () {
                $this->arrayList->add('string1');
                $this->arrayList->add('string2');
                $this->arrayList->add('string3');
                $this->arrayList->add('string4');
                $this->arrayList->removeRange(1,2);
                expect($this->arrayList->toArray())->toBeA('array')->toBe(['string1','string4']);
                expect($this->arrayList->get(0))->toBe('string1');
                expect($this->arrayList->size())->toBe(2);

            });
            it('to remove range with wrong index', function () {
                $this->arrayList->add('1');
                $this->arrayList->add('2');
                $this->arrayList->add('3');
                expect($this->arrayList->toArray())->toBeA('array')->toBe(['1', '2', '3']);
                $closure = function(){
                    $this->arrayList->removeRange(10,15);
                };
                expect($closure)->toThrow(new IndexOutOfBoundsException());

            });
            it('to remove range with wrong range', function () {
                $this->arrayList->add('1');
                $this->arrayList->removeRange(0,0);
                expect($this->arrayList->size())->toBe(1);

            });
        }
    );

});
