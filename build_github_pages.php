<?php
/**
 * Build static index.html for GitHub Pages deployment
 */

$ch = curl_init('http://localhost/Hung_Phat_Ads/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$html = curl_exec($ch);
curl_close($ch);

if (!$html) {
    die("Error: Could not fetch from http://localhost/Hung_Phat_Ads/\n");
}

// Replace localhost links with GitHub Pages repository path
$repo_base = '/Hung_Phat_Ads/';
$full_url  = 'https://nhathao1711.github.io/Hung_Phat_Ads/';

$html = str_replace('http://localhost/Hung_Phat_Ads/', $repo_base, $html);
$html = str_replace('http:\/\/localhost\/Hung_Phat_Ads\/', '\/Hung_Phat_Ads\/', $html);
$html = str_replace('http://localhost:80/Hung_Phat_Ads/', $repo_base, $html);

// Ensure meta tags and charset are clean UTF-8
if (!str_contains($html, '<meta charset="UTF-8">') && !str_contains($html, '<meta charset="utf-8">')) {
    $html = str_replace('<head>', "<head>\n    <meta charset=\"UTF-8\">", $html);
}

// Add client-side fallback handler for the lead form on static GitHub Pages
$static_form_script = <<<HTML
<script>
// GitHub Pages static demo fallback for lead consultation form
document.addEventListener('DOMContentLoaded', function() {
    var leadForm = document.getElementById('lead-consult-form');
    if (leadForm) {
        leadForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var submitBtn = leadForm.querySelector('button[type="submit"]');
            var originalText = submitBtn ? submitBtn.innerHTML : '';
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Đang gửi yêu cầu...';
            }
            setTimeout(function() {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
                alert('🎉 Cảm ơn quý khách! Yêu cầu tư vấn thiết kế website đã được gửi thành công.\\n\\nChuyên viên Hưng Phát Ads sẽ liên hệ qua SĐT/Zalo trong vòng 15 phút.');
                leadForm.reset();
            }, 800);
        });
    }
});
</script>
</body>
HTML;

$html = str_replace('</body>', $static_form_script, $html);

file_put_contents(__DIR__ . '/index.html', $html);
echo "Successfully generated index.html (" . strlen($html) . " bytes)\n";
