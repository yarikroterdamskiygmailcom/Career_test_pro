export default {
    name: 'information-and-start',
    components: {},
    props: [],
    data() {
        return {
            information: '<div>Welcome to <strong>CareertestPro.com</strong>, the most comprehensive international career' +
                ' test available online!</div><br>' +
                '\n' +
                '<div>CareertestPro.com uses a database of over  <strong>3,000 professions</strong> ' +
                'and corresponding educational levels.</div><br>' +
                '\n' +
                '<div>Taking the test will take you about 15 minutes.</div><br>' +
                '\n' +
                '<div>The test consist of  <strong>10 Steps</strong>' +
                ' with 30 questions in each step,  <strong>regard to skills, work values, ' +
                'activities, personal behavior and professions:</strong></div><br>' +
                '\n' +
                '<div> <strong>Step 1</strong>  and  <strong>Step 2</strong> include questions regard ' +
                'to  <strong>skills.</strong></div>' +
                '<div> <strong>Step 3</strong> and  <strong>Step 4</strong> - questions regard to ' +
                ' <strong>work values.</strong></div>' +
                '<div> <strong>Step 5</strong> and  <strong>Step 6</strong> - questions regard to' +
                '  <strong>activities.</strong></div>' +
                '<div> <strong>Step 7</strong> and  <strong>Step 8</strong> - questions regard to ' +
                ' <strong>personal behavior.</strong></div>' +
                '<div> <strong>Step 9</strong> and  <strong>Step 10</strong> - questions regard to ' +
                ' <strong>occupations (professions).</strong></div><br>' +
                '\n' +
                '<div>When clicking on the  <strong>“Let’s Go!” button</strong> below, there will be a list of' +
                ' questions, ' +
                'which you need to answer one by one.</div><br>' +
                '\n' +
                '<div>It’s up to you to be as accurate as possible in your answers to the statements.</div><br>' +
                '\n' +
                '<div>Before every questionnaire there is a  <strong>brief explanation</strong>' +
                '<div class="info">i</div>of it purpose and what action' +
                ' is required from you.</div><br>' +
                '\n' +
                '<div>It’s important to read the given statements carefully' +
                ' and follow with your intuition when answering.</div><br>' +
                '\n' +
                '<div>After completing the test you’ll receive the report.</div>'
        }
    },
    computed: {},
    mounted() {

    },
    methods: {
        start_test(){
            this.$router.push({path: '/tests/1'})
        }
    }
}
