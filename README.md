# coreBOS Benchmarks

coreBOS infrastructure for benchmark performance analysis based on [PHPBench](https://github.com/phpbench/phpbench).

- clone the repository into the `build/evBench` directory
- create a benchmark script following the [PHPBench documentation guidelines](https://phpbench.readthedocs.io/) and include at the top of the script the `loadcorebos.php` script to have access to all the coreBOS infrastructure
- I recommend creating the same directory structure we have in the application to match the scripts and find them easily like we do in the unit test project
- run the benchmark with `build/evBench/phpbench.phar run build/evBench/{path to script} --report=aggregate`
- to run all the benchmarks use `build/evBench/phpbench.phar run --config=$PWD/build/evBench/phpbench.json --report=aggregate`

### Example

You can see an example of benchmarking the `getCurrencyName` and `popup_from_html` functions in the script `build/evBench/include/utils/CommonUtilsBench.php`, which would be executed, from the root of your coreBOS install, with this command

`build/evBench/phpbench.phar run build/evBench/include/utils/CommonUtilsBench.php --report=aggregate`

```shell
joe@joebordes:/var/www/coreBOSNG$ build/evBench/phpbench.phar run build/evBench/include/utils/CommonUtils.php --report=aggregate
PHPBench (1.2.10) running benchmarks... #standwithukraine
with PHP version 8.2.7, xdebug ✔, opcache ❌

\CommonUtilsBench

    benchgetCurrencyName....................I4 - Mo1.801μs (±9.46%)
    benchgpopup_from_html...................I4 - Mo1.729μs (±1.13%)

Subjects: 2, Assertions: 0, Failures: 0, Errors: 0
+------------------+-----------------------+-----+------+-----+----------+---------+--------+
| benchmark        | subject               | set | revs | its | mem_peak | mode    | rstdev |
+------------------+-----------------------+-----+------+-----+----------+---------+--------+
| CommonUtilsBench | benchgetCurrencyName  |     | 1000 | 5   | 21.985mb | 1.801μs | ±9.46% |
| CommonUtilsBench | benchgpopup_from_html |     | 1000 | 5   | 21.985mb | 1.729μs | ±1.13% |
+------------------+-----------------------+-----+------+-----+----------+---------+--------+
```

**Share your benchmarks!**

