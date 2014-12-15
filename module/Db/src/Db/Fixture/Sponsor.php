<?php

namespace Db\Fixture;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Db\Entity;

class Sponsor implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $sponsor = new Entity\Sponsor();
        $sponsor->setName('AppDynamics, Inc');
        $sponsor->setUrl('http://www.appdynamics.com/');
        $sponsor->setLogoUrl('http://www.gabsha.com/images/AppDynamics.png');
        $manager->persist($sponsor);

        $sponsor = new Entity\Sponsor();
        $sponsor->setName('CBS Interactive');
        $sponsor->setUrl('http://www.cbsinteractive.com/');
        $sponsor->setLogoUrl('https://c2.staticflickr.com/4/3056/2647025910_24812c5c00.jpg');
        $manager->persist($sponsor);

        $sponsor = new Entity\Sponsor();
        $sponsor->setName('Engine Yard');
        $sponsor->setUrl('https://www.engineyard.com/');
        $sponsor->setLogoUrl('https://d3s754z2ghtmdv.cloudfront.net/assets/global/icon-1948d921b4e578a27974a37b54db70ab.svg');
        $manager->persist($sponsor);

        $sponsor = new Entity\Sponsor();
        $sponsor->setName('IGN Entertainment, Inc.');
        $sponsor->setUrl('http://corp.ign.com/');
        $sponsor->setLogoUrl('https://lh5.ggpht.com/o4TLwXw2A8XzcVMAv47nEePwYnv-8Kw7P2TCD5FtOzw2KImHLGph2dXd-Ok_795dUfg=w300');
        $manager->persist($sponsor);

        $sponsor = new Entity\Sponsor();
        $sponsor->setName('Microsoft');
        $sponsor->setUrl('http://www.microsoft.com/');
        $sponsor->setLogoUrl('http://www.microsoft.com/en-us/server-cloud/Images/shared/page-sharing-thumbnail.jpg');
        $manager->persist($sponsor);

        $sponsor = new Entity\Sponsor();
        $sponsor->setName('BigCommerce');
        $sponsor->setUrl('https://www.bigcommerce.com/');
        $sponsor->setLogoUrl('https://d1zu5lttu3m0bt.cloudfront.net/assets/cms/bigcommerce-logo-82a234ef7f226d015d294cc0b66fc35f.png');
        $manager->persist($sponsor);

        $sponsor = new Entity\Sponsor();
        $sponsor->setName('Constant Contact');
        $sponsor->setUrl('http://www.constantcontact.com/');
        $sponsor->setLogoUrl('http://static.ctctcdn.com/lp/images/standard/bv2/share/constant-contact-share-logo.gif');
        $manager->persist($sponsor);

        $sponsor = new Entity\Sponsor();
        $sponsor->setName('Digg');
        $sponsor->setUrl('http://www.digg.com/');
        $sponsor->setLogoUrl('http://registroen.com/wp-content/uploads/2014/08/Digg.png');
        $manager->persist($sponsor);

        $sponsor = new Entity\Sponsor();
        $sponsor->setName('Digital Garage Development LLC');
        $sponsor->setUrl('http://www.garage.co.jp/en/');
        $sponsor->setLogoUrl('http://www.microsoft.com/global/ja-jp/casestudies/PublishingImages/showcase/5000/5663-WI1/5663-WI1_logo.gif');
        $manager->persist($sponsor);

        $sponsor = new Entity\Sponsor();
        $sponsor->setName('Hawthorn');
        $sponsor->setUrl('http://hawthornsf.com/');
        $sponsor->setLogoUrl('http://cdn.evbuc.com/images/7000789/106679522699/1/logo.jpg');
        $manager->persist($sponsor);

        $sponsor = new Entity\Sponsor();
        $sponsor->setName('Lithium Technologies');
        $sponsor->setUrl('http://www.lithium.com/');
        $sponsor->setLogoUrl('http://allfacebook.com/files/2012/10/LithiumTechnologiesFBLogo.jpg');
        $manager->persist($sponsor);

        $sponsor = new Entity\Sponsor();
        $sponsor->setName('Mashery, Inc.');
        $sponsor->setUrl('http://mashery.com/');
        $sponsor->setLogoUrl('http://www.mashery.com/sites/default/files/Mashery%20Logo.png');
        $manager->persist($sponsor);

        $sponsor = new Entity\Sponsor();
        $sponsor->setName('This Moment');
        $sponsor->setUrl('http://www.thismoment.com/');
        $sponsor->setLogoUrl('https://d1ncmqs035wa42.cloudfront.net/other/1352317808-1535.jpg');
        $manager->persist($sponsor);

        $sponsor = new Entity\Sponsor();
        $sponsor->setName('if(we)');
        $sponsor->setUrl('http://ifwe.co/');
        $sponsor->setLogoUrl('http://tctechcrunch2011.files.wordpress.com/2014/10/unnamed-2.png?w=738');
        $manager->persist($sponsor);

        $manager->flush();
    }
}
