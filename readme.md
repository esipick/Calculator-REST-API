# Caculator #

This Application perform mathematical calculations like addition, subtract, division and multiplication on 'n'
 number of operands.
 
### Deployment Steps ###

* Clone 
* Composer install
* cp .env.example to .env
    

### Api EndPoints ###

*  Addition http://localhost/add/4/3/4
*  Multiplication http://localhost/multiply/5/6/7/6.4
*  Subtraction http://localhost/subtract/4/3.4/1
*  Division http://localhost/divide/5/2/3

### Notes ###
* if user request same query params the result should be returned from cache 
