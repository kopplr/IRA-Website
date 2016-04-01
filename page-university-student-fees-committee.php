<?php get_header(); ?>
<div class="site-title">
    <?php while ( have_posts() ) : the_post(); ?>


        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="entry-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </header>
        </article>



        <?php endwhile; ?>
</div>
<div class="site-content">
    <div class="sidebar-column">
    </div>
    <div class="main-column">


        <div id="fees-committee-content">
            <p><h2>University Student Fees Committee Terms of Reference</h2></p>
            <h3>Mandate</h3>
            <ul>
              <li>recommending all revisions to tuition (undergraduate and graduate degree, diploma and certificate) and supplementary fees to the Budget Committee;</li>
              <li>establishing deadlines for the submission of all proposed tuition and supplementary fees to the University Student Fees Committee;</li>
              <li>recommending policy guidelines to the Budget Committee that outline services and materials for which fees can be charged;</li>
              <li>recommending policy guidelines to the Budget Committee for charging fees for existing and new programs that are not funded through grants from the Ministry of Training, Colleges and Universities;</li>
              <li>ensuring that all proposed changes to existing student fees and all proposed new fees are reasonable, conform to government regulations and have been approved through appropriate processes within the University; and,</li>
              <li>ensuring that proposed changes to student fees are feasible and do not involve undue complications to calculate and administer; where appropriate, determining the most "tax efficient" method for students who are being charged these fees.</li>
            </ul>
            <h3>Members</h3>
            <ul>
              <li>Associate Vice President, Institutional Research and  Analysis (Chair)</li>
              <li>Associate Vice President, Students and Learning</li>
              <li>Associate Vice President, Faculty</li>
              <li>Associate Vice-President and Dean of Graduate Studies</li>
              <li>Director, Education Services, Faculty of Health  Sciences</li>
              <li>Director of Finance</li>
              <li>University Registrar</li>
              <li>Graduate Student Representative &ndash; selected from  applicants for a 1 year term, renewable for a second 1 year term</li>
              <li>Full-time Undergraduate Student Representative &ndash; selected  from applicants for a 1 year term, renewable for a second 1 year term</li>
              <li>Part-time Undergraduate Student Representative &ndash; selected  from applicants for a 1 year term, renewable for a second 1 year term</li>
            </ul>
            <h3>Permanent Consultants</h3>
            <ul>
              <li>Executive Director, Finance and Administration, Office  of the Provost </li>
              <li>Assistant Dean, Student Affairs/Director of Student Success  Centre</li>
              <li>Associate Registrar and Graduate Secretary </li>
              <li>Manager, Receipts and Receivables, Financial Services</li>
              <li>Manager, University Affiliates and Association </li>
              <li>Director, Student Financial Aid and Scholarships</li>
              <li>Senior Project Analyst, Institutional Research and  Analysis </li>
            </ul>
            <p>All meetings of this committee are closed sessions.</p>
            <em> Revised: February 10, 2015</em>
            <p>&nbsp;</p>
             <p><a href="#">University Student Fees Committee - Requests Template
            </a><img src="#" alt="Word" width="16" height="16" /> (Updated on May 4th, 2015)</p>
            <p><a href="#">University Student Fees Committee - Call for Nominations
            </a><img src="#" alt="PDF 2014" width="16" height="16" /> (Updated on September 25th, 2015)</p>
            <p><a href="#">University Student Fees Committee - Application Form for Student Representatives
            </a><img src="#" alt="PDF 2014" width="16" height="16" /> (Updated on September 25th, 2015)</p>
        </div>

    </div>
    <div class="secondary-column">
        <p>widget area</p>
    </div>
</div>

<?php get_footer(); ?>
</div>
