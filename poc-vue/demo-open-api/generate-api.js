import { generate } from 'openapi-typescript-codegen';

generate({
    input: './openapi.yaml',
    output: './src/api',
    client: 'axios',
    useOptions: true,
    useUnionTypes: true,
});
