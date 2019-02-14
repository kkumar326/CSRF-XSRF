<p align="center">
  <img height="100" src="https://pbs.twimg.com/profile_images/1081610141538111488/jA44QLOi_400x400.jpg">
</p>

___
<b>CSRF/ XSRF Security mini library for PHP applications. Embed and verify security tokens in forms without much hassle.</b>
___

[![Generic badge](https://img.shields.io/badge/author-Kshitij%20Kumar-red.svg)](https://twitter.com/kkumar326)
[![Generic badge](https://travis-ci.org/kkumar326/CSRF-XSRF.svg?branch=master)](https://travis-ci.org/kkumar326/CSRF-XSRF)
[![Latest Stable Version](https://poser.pugx.org/sciencehook/csrf-xsrf/v/stable)](https://packagist.org/packages/sciencehook/csrf-xsrf)
[![Test Coverage](https://api.codeclimate.com/v1/badges/6cefcce2aa8b6b26ac0a/test_coverage)](https://codeclimate.com/github/kkumar326/CSRF-XSRF/test_coverage)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kkumar326/CSRF-XSRF/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kkumar326/CSRF-XSRF/?branch=master)
[![Total Downloads](https://poser.pugx.org/sciencehook/csrf-xsrf/downloads)](https://packagist.org/packages/sciencehook/csrf-xsrf)
[![License](https://poser.pugx.org/sciencehook/csrf-xsrf/license)](https://packagist.org/packages/sciencehook/csrf-xsrf)

___

<h2>Table of Contents</h2>

<ol>
<li><a href="#installation">Installation</a></li>
<li><a href="#examples">Usage Examples</a></li>
<li><a href="#contribution">Contribution</a></li>
<li><a href="#license">License</a></li>
</ol>

___
<h3 id="installation">Installation</h3>

<h4 id="requirements">Requirements:</h4>

<b>PHP</b><br>
<p>This library is developed and tested on PHP 7.2. We do not know its backward compatibility. So, please test it before using it for PHP version less than 7.2.

<h4 id="install-steps">Steps:</h4>

<p>First, get <a href="https://getcomposer.org/download/">Composer</a>, if you don't already have it.</p>

<p>Next, run the following command in your terminal in PROJECT's directory:</p>
<code>composer require sciencehook/csrf-xsrf</code>

___

<h3 id="examples">Usage Examples</h3>

<p>You can find the working examples in <a href="https://github.com/kkumar326/CSRF-XSRF/tree/master/examples">examples</a> folder.</p>
<p><a href="https://github.com/kkumar326/CSRF-XSRF/blob/master/examples/input_form.php">input_form.php</a> is input form containing CSRF token and <a href="https://github.com/kkumar326/CSRF-XSRF/blob/master/examples/form_validation.php">form_validation.php</a> validates the token and proceeds accordingly.</p>

___

<h3 id="contribution">Contribution</h3>

<p>Please raise issues in case of any bugs or problems. To contribute, please create pull requests.</p>

___

<h3 id="license">License</h3>

<b>MIT License</b>

Copyright (c) 2018 <a href="https://sciencehook.com/">ScienceHook</a>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
