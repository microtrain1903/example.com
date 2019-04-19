<?php
require '../core/bootstrap.php';

$meta=[];
$meta['title']='Bob\'s Resume';

$content=<<<EOT
<h1 class="center">First Name Last Name</h1>   

<div class="center">
<a href="https://www.linkedin.com/in/shakirze/" target="_blank" rel="noopener">LinkedIn</a>
&#x25CF;
Some City, IL
<a href="https://github.com/eyeland" target="_blank" rel="noopener">Github</a>
&#x25CF;
Some City, IL
</div>

<h2 class="center">Senior Ameutar Mathematician</h2>
<p class="center">  I like to build stuff using math.</p>

<div class="ulWrap">

    <ul class="list">
        <li>Strong software design skill</li>
        <li>Knowledge of multiple stacks</li>
    </ul>

</div>

<h3 class="center">Core Competencies</h3>


<div class="ulWrap">
    <ul class="list">
        <li>Full Stack Development</li>
        <li>Front End Development</li>
        <li>Server Side programming</li>
</ul>
<ul class="list">
        <li>Hybrid Mobile Development</li>
        <li>Savvy Problem Solver</li>
        <li>Muscles</li>
</ul>
</div>

<h2 class="center">Certifications and Technical Proficiences</h2>
<div class="ulWrap">
    <ul class="list">
        <li>
            <em>Platforms</em>
            Linux, LAMP, MEAN, NodeJS
        </li>
        <li>
            <em>Databases</em>
            MySQL, MongoDB
        </li>
            <li>
            <em>Tools</em>
            VS Code, SSH, Gulp, Git
        </li>
        <li>
            <em>Languages</em>
            HTML, CSS, SASS, JavaScript, ES6, PHP, BASH, SQL TypeScript
            </li>
    </ul>
</div>

<h2 class="center">Professional Experience</h2>
<section class="center">
    <h2>Emplyeer 1 - Chicago, IL <span>June - Present</span></h2>
    <p>About the employeer</p>
    <h3>Job Title</h3>
    <div class="ulWrap">
        <ul class="list">
            <li>Job duty 1</li>
            <li>Job duty 2</li>
        </ul>
        <h4>Key Contributions</h4>
        <ul class="list">
            <li>Contribution 1</li>
            <li>Contribution 2</li>
        </ul>
    </div>

</section>
<h2 class="center">Education</h2>
<section class="center">
    <h3>MicroTrain Technologies - Chicago, IL <span>2018</span></h3>
    <h4>Agile Full Stack Web and Hybrid Mobile Application Development</h4>
</section>
EOT;

require '../core/layout.php';