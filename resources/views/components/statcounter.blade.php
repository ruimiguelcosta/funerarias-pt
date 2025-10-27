@php
    $tenant = app()->bound('tenant') ? app('tenant') : null;
    
    if (!$tenant || !$tenant->hasStatcounter()) {
        return;
    }
    
    $scProject = $tenant->getStatcounterProject();
    $scSecurity = $tenant->getStatcounterSecurity();
@endphp

<!-- Default Statcounter code for {{ $tenant->name }}
{{ $tenant->domain }} -->
<script type="text/javascript">
var sc_project={{ $scProject }};
var sc_invisible=1;
var sc_security="{{ $scSecurity }}";
</script>
<script type="text/javascript"
src="https://www.statcounter.com/counter/counter.js"
async></script>
<noscript><div class="statcounter"><a title="Web Analytics"
href="https://statcounter.com/" target="_blank"><img
class="statcounter"
src="https://c.statcounter.com/{{ $scProject }}/0/{{ $scSecurity }}/1/"
alt="Web Analytics"
referrerPolicy="no-referrer-when-downgrade"></a></div></noscript>
<!-- End of Statcounter Code -->
