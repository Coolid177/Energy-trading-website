<?= $this->section("title") ?>
Sitemap
<?= $this->endsection() ?>
<?= $this->extend("templates/base") ?>
<?= $this->section("content") ?>
<div class="mt-auto container">
    <h5>Accessibility statement</h5>
    <article class="container">
        Because this is a school project I will only discuss relevant topics, there is no use in saying this is an AAA accessible website.
        
        Energetic is committed to providing a website that is accessible to the widest possible audience, regardless of technology or ability. I am actively working to increase the accessibility and usability of our website and in doing so adhere to many of the available standards and guidelines.
        I have implemented the following measures to make my website more accessible:
        <ul>
            <li>Added ARIA labels to provide additional information about interactive elements for screen reader users and users who use a text based browser.</li>
            <li>All images and videos on my website have been given appropriate alt text to provide a clear description of the content for those who may be unable to view them. </li>
            <li>The website is accessible even without javascript. However, you will not be able to view your statistics or increase your shoppingcart.</li>
            <li>The website can not be entirely navigated by keyboard. I am still working on this to make it possible. </li>
            <li>Colors are not relevant for info, buttons come in green, blue and red and the action of the button is alwyas written on it, so more people can access it.</li>
            <li>Bootstrap is used as css framework, since bootstrap is a "mobile first" framework it renders excellently on every screen size</li>
        </ul>
        If you have any difficulty accessing my website or have feedback on how I can improve accessibility, please contact me at rune.rombouts@student.uhasselt.be.
        I will work with you to provide the information or assistance you need through an alternative format.
    </article>
</div>
<?= $this->endsection() ?>
